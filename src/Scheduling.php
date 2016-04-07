<?php
namespace SouhailMerroun\Schedulable;

use Exception;
use Carbon\Carbon;

trait Scheduling
{
    public function firstSchedule($request)
    {
        switch ($request->input('schedule_type')) 
        {
            case 'once':
                if($request->input('with_time'))
                {
                    $time = null;
                    $with_time = true;
                }
                else
                {
                    $with_time = null;
                    $time = empty($request->input('time')) ? null : $request->input('time');
                }

                $start_at = empty($request->input('start_at')) ? null : $request->input('start_at');
                $this->scheduleOnce($start_at, $time, $with_time);
            break;
            
            case 'every-day':
                if($request->input('with_time'))
                {
                    $time = null;
                    $with_time = true;
                }
                else
                {
                    $with_time = null;
                    $time = empty($request->input('time')) ? null : $request->input('time');
                }

                $end_at = empty($request->input('end_at')) ? null : $request->input('end_at');
                
                $this->scheduleEveryDay($request->input('start_at'), $time, $end_at, $with_time);               
            break;
                
            case 'every-giving-day':
                if($request->input('with_time'))
                {
                    $time = null;
                    $with_time = true;
                }
                else
                {
                    $with_time = null;
                    $time = empty($request->input('time')) ? null : $request->input('time');
                }

                $end_at = empty($request->input('end_at')) ? null : $request->input('end_at');
            
                $days = collect();
                $days_list = array(
                    'monday','tuesday','wednesday','thursday','friday','saturday','sunday'
                ); 
                foreach ($days_list as $day) 
                    $days->push($request->input($day));

                $this->scheduleEveryGivingDayOfTheWeek($request->input('start_at'), $time, $end_at, $days, $with_time);
            break;
                
            case 'every-giving-day-month':
                if($request->input('with_time'))
                {
                    $time = null;
                    $with_time = true;
                }
                else
                {
                    $with_time = null;
                    $time = empty($request->input('time')) ? null : $request->input('time');
                }

                $end_at = empty($request->input('end_at')) ? null : $request->input('end_at');
            
                $months = collect();
                $months_list = array(
                    'january','february','march','april','may','june','july','august','september','october','november','december'  
                );
                foreach ($months_list as $month) 
                    $months->push($request->input($month));
                
                $days = collect();
                $days_list = array(
                    1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31 
                ); 
                foreach($days_list as $day) 
                    $days->push($request->input($day));
                
                $this->scheduleEveryGivingDayOfTheMonth($request->input('start_at'), $time, $end_at, $months, $days, $with_time);
            break;
        }
    }
    
    public function nextSchedule()
    {
        $schedule_definition = Schedule_Definition::where('schedulable_id', $this->id)->first();
        
        switch ($schedule_definition->type) 
        {
            //Once schedules
            case 0:
            break;
            
            //Everyday schedules
            case 1:
                $time = empty($schedule_definition->time) ? null : $schedule_definition->time;
                $end_at = empty($schedule_definition->end_at) ? null : $schedule_definition->end_at;
                $last_schedule = Schedule::orderBy('ended_at', 'desc')->first();
                
                if($end_at != null && !Carbon::parse($end_at)->isToday())
                {
                    $schedule = new Schedule([
                        'schedulable_id' => $this->id,
                        'schedule_definition_id' => $schedule_definition->id,
                        'for_date' => Carbon::parse($last_schedule->for_date)->addDay(),
                        'user_id' => $schedule_definition->user_id,
                        'for_time' => $time
                    ]);
                    $this->schedules()->save($schedule);
                }
                else
                {
                    $schedule = new Schedule([
                        'schedulable_id' => $this->id,
                        'schedule_definition_id' => $schedule_definition->id,
                        'for_date' => Carbon::parse($last_schedule->for_date)->addDay(),
                        'user_id' => $schedule_definition->user_id,
                        'for_time' => $time
                    ]);
                    $this->schedules()->save($schedule);
                }
            break;
                
            //Every giving day of the week
            case 2:
                $time = empty($schedule_definition->time) ? null : $schedule_definition->time;
                $end_at = empty($schedule_definition->end_at) ? null : $schedule_definition->end_at;
                $last_schedule = Schedule::orderBy('ended_at', 'desc')->first();
                
                /* Get the closest day in the schedule definition */
                $closestDay;
                
                if($schedule_definition->monday == 1)
                    $closestDay[Carbon::MONDAY] = Carbon::parse($last_schedule->for_date)->diffInDays(Carbon::parse($last_schedule->for_date)->next(Carbon::MONDAY));
                    
                if($schedule_definition->tuesday == 1)
                    $closestDay[Carbon::TUESDAY] = Carbon::parse($last_schedule->for_date)->diffInDays(Carbon::parse($last_schedule->for_date)->next(Carbon::TUESDAY));
                    
                if($schedule_definition->wednesday == 1)
                    $closestDay[Carbon::WEDNESDAY] = Carbon::parse($last_schedule->for_date)->diffInDays(Carbon::parse($last_schedule->for_date)->next(Carbon::WEDNESDAY));
                 
                if($schedule_definition->thursday == 1)
                    $closestDay[Carbon::THURSDAY] = Carbon::parse($last_schedule->for_date)->diffInDays(Carbon::parse($last_schedule->for_date)->next(Carbon::THURSDAY));
                    
                if($schedule_definition->friday == 1)
                    $closestDay[Carbon::FRIDAY] = Carbon::parse($last_schedule->for_date)->diffInDays(Carbon::parse($last_schedule->for_date)->next(Carbon::FRIDAY));
                    
                if($schedule_definition->saturday == 1)  
                    $closestDay[Carbon::SATURDAY] = Carbon::parse($last_schedule->for_date)->diffInDays(Carbon::parse($last_schedule->for_date)->next(Carbon::SATURDAY));
                
                if($schedule_definition->sunday == 1)
                     $closestDay[Carbon::SUNDAY] = Carbon::parse($last_schedule->for_date)->diffInDays(Carbon::parse($last_schedule->for_date)->next(Carbon::SUNDAY));
                     
                /* Use the closest day for the next schedule */     
                if(array_keys($closestDay, min($closestDay))[0] == Carbon::MONDAY)
                    $nextSchedule = Carbon::parse($last_schedule->for_date)->next(Carbon::MONDAY);
                
                if(array_keys($closestDay, min($closestDay))[0] == Carbon::TUESDAY)
                    $nextSchedule = Carbon::parse($last_schedule->for_date)->next(Carbon::TUESDAY);
                
                if(array_keys($closestDay, min($closestDay))[0] == Carbon::WEDNESDAY)
                    $nextSchedule = Carbon::parse($last_schedule->for_date)->next(Carbon::WEDNESDAY);
                
                if(array_keys($closestDay, min($closestDay))[0] == Carbon::THURSDAY)
                    $nextSchedule = Carbon::parse($last_schedule->for_date)->next(Carbon::THURSDAY);
                    
                if(array_keys($closestDay, min($closestDay))[0] == Carbon::FRIDAY)
                    $nextSchedule = Carbon::parse($last_schedule->for_date)->next(Carbon::FRIDAY);
                    
                if(array_keys($closestDay, min($closestDay))[0] == Carbon::SATURDAY)
                    $nextSchedule = Carbon::parse($last_schedule->for_date)->next(Carbon::SATURDAY);
                    
                if(array_keys($closestDay, min($closestDay))[0] == Carbon::SUNDAY)
                    $nextSchedule = Carbon::parse($last_schedule->for_date)->next(Carbon::SUNDAY);

                if($end_at != null && !Carbon::parse($end_at)->isToday())
                {
                    $schedule = new Schedule([
                        'schedulable_id' => $this->id,
                        'schedule_definition_id' => $schedule_definition->id,
                        'for_date' => $nextSchedule,
                        'user_id' => $schedule_definition->user_id,
                        'for_time' => $time
                    ]);
                    $this->schedules()->save($schedule);
                }
                else
                {
                    $schedule = new Schedule([
                        'schedulable_id' => $this->id,
                        'schedule_definition_id' => $schedule_definition->id,
                        'for_date' => $nextSchedule,
                        'user_id' => $schedule_definition->user_id,
                        'for_time' => $time
                    ]);
                    $this->schedules()->save($schedule);
                }
            break;
                
            case 3:
            
            break;
        }
    }
    
    public function accomplishSchedule($id)
	{
        $schedule = Schedule::findOrFail($id);
        $schedule->state = 1;
        $schedule->ended_at = Carbon::now();
        $schedule->save();
        
        $this->nextSchedule();
	}
    
    public function abortSchedule($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->state = -1;
        $schedule->ended_at = Carbon::now();
        $schedule->save();
        
        $this->nextSchedule();
    }
}


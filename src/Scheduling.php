<?php
namespace SouhailMerroun\Schedulable;

trait Scheduling
{
    public function firstSchedule($request)
    {
        switch ($request->input('schedule_type')) 
        {
            case 'once':
                if($request->input('with_time'))
                    $this->scheduleOnce($request->input('start_at'), $request->input('time')); 
                else
                    $this->scheduleOnce($request->input('start_at')); 
            break;
            
            case 'every-day':
            
                if($request->input('with_time'))
                    if($request->input('end_at'))
                        $this->scheduleEveryDay($request->input('start_at'), $request->input('time'), $request->input('end_at'));
                    else
                        $this->scheduleEveryDay($request->input('start_at'), $request->input('time'));
                else
                    if($request->input('end_at'))
                        $this->scheduleEveryDay($request->input('start_at'), null, $request->input('end_at'));
                    else
                        $this->scheduleEveryDay($request->input('start_at'));
               
            break;
                
            case 'every-giving-day':
            
                $days = collect();
                $days_list = array(
                    'monday','tuesday','wednesday','thursday','friday','saturday','sunday'
                ); 
                foreach ($days_list as $day) 
                    $days->push($request->input($day));

                if($request->input('with_time'))
                    if($request->input('end_at'))
                        $this->scheduleEveryGivingDayOfTheWeek($request->input('start_at'), $request->input('time'), $request->input('end_at'), $days);
                    else
                        $this->scheduleEveryGivingDayOfTheWeek($request->input('start_at'), $request->input('time'), null, $days);
                else
                    if($request->input('end_at'))
                        $this->scheduleEveryGivingDayOfTheWeek($request->input('start_at'), null, $request->input('end_at'), $days);
                    else
                        $this->scheduleEveryGivingDayOfTheWeek($request->input('start_at'), null, null, $days);
                
            break;
                
            case 'every-giving-day-month':
            
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
                
                if($request->input('with_time'))
                    if($request->input('end_at'))
                        $this->scheduleEveryGivingDayOfTheMonth($request->input('start_at'), $request->input('time'), $request->input('end_at'), $months, $days);
                    else
                        $this->scheduleEveryGivingDayOfTheMonth($request->input('start_at'), $request->input('time'), null, $months, $days);
                else
                    if($request->input('end_at'))
                        $this->scheduleEveryGivingDayOfTheMonth($request->input('start_at'), null, $request->input('end_at'), $months ,$days);
                    else
                        $this->scheduleEveryGivingDayOfTheMonth($request->input('start_at'), null, null, $months, $days);
            break;
        }
    }
    
    public function nextSchedule()
    {
        
    }
    
    public function accomplishSchedule()
	{
        //Change state to 1
        

        $this->nextSchedule();
	}
    
    public function abortSchedule()
    {
        //Change state to -1

        $this->nextSchedule();
    }
}


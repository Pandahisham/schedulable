<?php
namespace SouhailMerroun\Schedulable;

use Auth;
use Carbon\Carbon;

trait Definings
{
    public function scheduleOnce(Carbon $datetime, $userId = null)
    {
        //If the userId is not declared take the logged in
        $userId = (empty($userId)) ? Auth::user()->id : $userId;

        $date = $datetime;
        $time = $datetime;
        
        //If the startDate is not declared take the now as startDate
        $date = (empty($date)) ? Carbon::now()->format('Y-m-d') : $date->format('Y-m-d');
        
        //If the time is definied get the format of 'H:i' else keep it null
        $time = (!empty($time)) ? $time->format('H:i') : null;
        
        //Schedule in the database :
        /* The schedule details :
            -- type : 0
            -- date = $date
        
        /* The schedule list : 
           Add the first schedule in the schedules list
           
            -- scheduled_id => the inserted schedule 
            -- for_date => $startDate
            -- time => $time
        */
        
        $schedule_definition = new Schedule_Definition([
            'schedulable_id' => $this->id,
            'type' => 0,
            'user_id' => $userId,
            'date' => $date,
            'time' => $time
        ]);
        $this->schedule_definition()->save($schedule_definition);
        
        $schedule = new Schedule([
            'schedulable_id' => $this->id,
            'schedule_id' => $schedule_definition->id,
            'for_date' => $date,
            'for_time' => $time,
            'user_id' => $userId,
            'time' => $time
        ]);
        $schedule_definition->schedules()->save($schedule);
    }
    
    //Schedule everyday from a startDate to an endDate if set
    public function scheduleEveryDay(Carbon $startDate = null, Carbon $time = null , Carbon $endDate = null, $userId = null)
    {
        //If the startDate is not declared take the now as startDate
        $startDate = (empty($startDate)) ? Carbon::now()->format('Y-m-d') : $startDate->format('Y-m-d');
        
        //If the endDate is definied get the format of 'Y-m-d' else keep it null
        $endDate = (!empty($endDate)) ? $endDate->format('Y-m-d') : null;
        
        //If the time is definied get the format of 'H:i' else keep it null
        $time = (!empty($time)) ? $time->format('H:i') : null;
        
        $schedule_definition = new Schedule_Definition([
            'schedulable_id' => $this->id,
            'type' => 1,
            'start_at' => $startDate,
            'end_at' => $endDate,
            'time' => $time,
            'monday' => true,
            'tuesday' => true,
            'wednesday' => true,
            'thursday' => true,
            'friday' => true,
            'saturday' => true,
            'sunday' => true
        ]);
        $this->schedule_definition()->save($schedule_definition);
        $schedule = new Schedule([
            'schedulable_id' => $this->id,
            'schedule_id' => $schedule_definition->id,
            'for_date' => $startDate,
            'user_id' => $userId,
            'for_time' => $time
        ]);
        $schedule_definition->schedules()->save($schedule);
    }
    
    public function scheduleEveryDayOfTheWeek($userId = null, Carbon $startDate = null, Carbon $time = null , Carbon $endDate = null, Collection $days)
    {
        $days = collect('monday','tuesday','wednesday','thursday','friday','saturday','sunday');
        //The schedule in schedules
        /*-- type : 2
        -- start_at = $startDate
        -- end_at = $endDate
        -- m = $days->contains('monday')
        -- t = $days->contains('tuesday')
        -- w = $days->contains('wednesday')
        
        //The first schedule in the schedules list
        -- scheduled_id => last_id
        -- for_date => $startDate
        -- time => $time*/
    }
    
    public function scheduleEveryDayOfTheMonth($userId = null, Carbon $startDate = null, Carbon $time = null , Carbon $endDate = null, Collection $days, Collection $months)
    {
        //The schedule in schedules
        /*-- type : 2
        -- start_at = $startDate
        -- end_at = $endDate
        -- m = $days->contains('monday')
        -- t = $days->contains('tuesday')
        -- w = $days->contains('wednesday')
        
        //The first schedule in the schedules list
        -- scheduled_id => last_id
        -- for_date => $startDate
        -- time => $time*/
    }
    
    public function schedule($startDate = null, $endDate = null, $type = null, array $days = null, array $month = null, $dayOfMonth = null)
    {
       
    }
}
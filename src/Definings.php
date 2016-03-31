<?php
namespace SouhailMerroun\Schedulable;

use Auth;
use Carbon\Carbon;

trait Definings
{
    public function scheduleOnce($userId = null, Carbon $date = null, Carbon $time = null)
    {
        //If the userId is not declared take the logged in
        $userId = (empty($userId)) ? Auth::user()->id : $userId;
        
        //If the startDate is not declared take the now as startDate
        $date = (empty($date)) ? Carbon::now()->format('Y-m-d') : $date;
        
        //If the time is definied get the format of 'H:i' else keep it null
        $time = (!empty($time)) ? Carbon::now()->format('H:i') : $time;
        
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
            'for_date' => $date,
            'user_id' => $userId,
            'time' => $time
        ]);
        $schedule_definition->schedules()->save($schedule);
    }
    
    //Schedule everyday from a startDate to an endDate if set
    public function scheduleEveryDay($userId = null, Carbon $startDate = null, Carbon $time = null , Carbon $endDate = null)
    {
        $days = collect('monday','tuesday','wednesday','thursday','friday','saturday','sunday');
        
        //If the startDate is not declared take the now as startDate
        $startDate = (empty($startDate)) ? Carbon::now()->format('Y-m-d') : $startDate;
        
        //If the endDate is definied get the format of 'Y-m-d' else keep it null
        $endDate = (!empty($endDate)) ? Carbon::now()->format('Y-m-d') : $endDate;
        
        //If the time is definied get the format of 'H:i' else keep it null
        $time = (!empty($time)) ? Carbon::now()->format('H:i') : $time;
        
        
        //Schedule in the database :
        /* The schedule details :
            -- type : 1
            -- start_at = $startDate
            -- end_at = $endDate
            -- monday,tuesday,wednesday,thursday,friday,saturday,sunday = true
        
        /* The schedule list : 
           Add the first schedule in the schedules list
           
            -- scheduled_id => the inserted schedule 
            -- for_date => $startDate
            -- time => $time
        */
    }
    
    public function scheduleEveryDayOfTheWeek($userId = null, Carbon $startDate = null, Carbon $time = null , Carbon $endDate = null, Collection $days)
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
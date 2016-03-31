<?php
namespace SouhailMerroun\Schedulable;

use SouhailMerroun\Schedulable\Schedule;
use DB;

trait Schedulable
{
    use Schedulable_Relations;
    use Definings;
    use Scheduling;   
    
    public static function GetWithNoSchedulings()
    {
        $tasks = DB::table('tasks')->join('schedules_definitions', 'schedules_definitions.schedulable_id', '=', 'tasks.id')
                                   ->join('schedules', 'schedules.schedulable_id', '=', 'tasks.id')
                                   ->select('tasks.*')
                                   ->whereNull('schedules.ended_at')
                                   ->whereNull('schedules.state')
                                   ->where('schedules_definitions.type', 0)
                                   ->get();
        dd($tasks);
    } 
}
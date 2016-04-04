<?php
namespace SouhailMerroun\Schedulable;

use SouhailMerroun\Schedulable\Schedule;
use Illuminate\Support\Collection;
use Carbon\Carbon;

trait Data
{
    public $notScheduled;
    public $upComming;
    
    public function isScheduledOnce()
    {
        return $this->schedule_definition()->where('type', 0)->first();
    }
    
    public function isScheduledEveryday()
    {
        return $this->schedule_definition()->where('type', 1)->first();
    }
    
    public function isScheduledEveryGivingDay()
    {
        return $this->schedule_definition()->where('type', 2)->first();
    }
    
    public function isScheduledEveryGivingDayMonth()
    {
        return $this->schedule_definition()->where('type', 3)->first();
    }
    
    public function getAccomplishedSchedules()
    {
        return $this->schedules()->where('state', 1)->whereNotNull('ended_at')->get();
    }
    
    public function getAbortedSchedules()
    {
        return $this->schedules()->where('state', -1)->whereNotNull('ended_at')->get();
    }
}
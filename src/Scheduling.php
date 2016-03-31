<?php
namespace SouhailMerroun\Schedulable;

trait Scheduling
{
    public function nextSchedule()
    {
        
    }
    
    public function accomplish()
	{
        //Change state to 1
        dd($this);
	}
    
    public function abandon()
    {
        //Change state to -1
    }
}


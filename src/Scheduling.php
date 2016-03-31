<?php
namespace SouhailMerroun\Schedulable;

trait Scheduling
{
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


<?php
namespace SouhailMerroun\Schedulable;

use Illuminate\Support\Collection;

trait Definings
{
    public function scheduleOnce($date, $time = null, $userId = null)
    {
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
    
    public function scheduleEveryDay($startDate , $time = null , $endDate = null, $userId = null)
    {
        $schedule_definition = new Schedule_Definition([
            'schedulable_id' => $this->id,
            'type' => 1,
            'start_at' => $startDate,
            'end_at' => $endDate,
            'time' => $time,
            'user_id' => $userId,
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
    
    public function scheduleEveryGivingDayOfTheWeek($startDate , $time = null , $endDate = null, Collection $days, $userId = null)
    {
        $monday = false;
        $tuesday = false;
        $wednesday = false;
        $thursday = false;
        $friday = false;
        $saturday = false;
        $sunday = false;
        
        if($days->contains('monday'))
            $monday = true;
        if($days->contains('tuesday'))
            $tuesday = true;
        if($days->contains('wednesday'))
            $wednesday = true;
        if($days->contains('thursday'))
            $thursday = true;
        if($days->contains('friday'))
            $friday = true;
        if($days->contains('saturday'))
            $saturday = true;
        if($days->contains('sunday'))
            $sunday = true;
            
        $schedule_definition = new Schedule_Definition([
            'schedulable_id' => $this->id,
            'type' => 2,
            'start_at' => $startDate,
            'end_at' => $endDate,
            'time' => $time,
            'user_id' => $userId,
            'monday' => $monday,
            'tuesday' => $tuesday,
            'wednesday' => $wednesday,
            'thursday' => $thursday,
            'friday' => $friday,
            'saturday' => $saturday,
            'sunday' => $sunday
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
    
    public function scheduleEveryGivingDayOfTheMonth($startDate , $time = null , $endDate = null, Collection $months, Collection $days, $userId = null)
    {
        $january = false;
        $february = false;
        $march = false;
        $april = false;
        $may = false;
        $june = false;
        $july = false;
        $august = false;
        $september = false;
        $october = false;
        $november = false;
        $december = false;
        
        $day1 = false;
        $day2 = false;
        $day3 = false;
        $day4 = false;
        $day5 = false;
        $day6 = false;
        $day7 = false;
        $day8 = false;
        $day9 = false;
        $day10 = false;
        $day11= false;
        $day12= false;
        $day13= false;
        $day14= false;
        $day15= false;
        $day16= false;
        $day17= false;
        $day18= false;
        $day19= false;
        $day20= false;
        $day21= false;
        $day22= false;
        $day23= false;
        $day24= false;
        $day25= false;
        $day26= false;
        $day27= false;
        $day28= false;
        $day29= false;
        $day30= false;
        $day31= false;
        
        if($months->contains('january'))
            $january = true;
        if($months->contains('february'))
            $february = true;
        if($months->contains('march'))
            $march = true;
        if($months->contains('april'))
            $april = true;
        if($months->contains('may'))
            $may = true;
        if($months->contains('june'))
            $june = true;
        if($months->contains('july'))
            $july = true;
        if($months->contains('august'))
            $august = true;
        if($months->contains('september'))
            $september = true;
        if($months->contains('october'))
            $october = true;
        if($months->contains('november'))
            $november = true;
        if($months->contains('december'))
            $december = true;
            
        if($days->contains(1))
            $day1 = true;
        if($days->contains(2))
            $day2 = true;
        if($days->contains(3))
            $day3 = true;
        if($days->contains(4))
            $day4 = true;
        if($days->contains(5))
            $day5 = true;
        if($days->contains(6))
            $day6 = true;
        if($days->contains(7))
            $day7 = true;
        if($days->contains(8))
            $day8 = true;
        if($days->contains(9))
            $day9 = true;
        if($days->contains(10))
            $day10 = true;
        if($days->contains(11))
            $day11 = true;
        if($days->contains(12))
            $day12 = true;
        if($days->contains(13))
            $day13 = true;
        if($days->contains(14))
            $day14 = true;
        if($days->contains(15))
            $day15 = true;
        if($days->contains(16))
            $day16 = true;
        if($days->contains(17))
            $day17 = true;
        if($days->contains(18))
            $day18 = true;
        if($days->contains(19))
            $day19 = true;
        if($days->contains(20))
            $day20 = true;
        if($days->contains(21))
            $day21 = true;
        if($days->contains(22))
            $day22 = true;
        if($days->contains(23))
            $day23 = true;
        if($days->contains(24))
            $day24 = true;
        if($days->contains(25))
            $day25 = true;
        if($days->contains(26))
            $day26 = true;
        if($days->contains(27))
            $day27 = true;
        if($days->contains(28))
            $day28 = true;
        if($days->contains(29))
            $day29 = true;
        if($days->contains(30))
            $day30 = true;
        if($days->contains(31))
            $day31 = true;
            
        $schedule_definition = new Schedule_Definition([
            'schedulable_id' => $this->id,
            'type' => 3,
            'start_at' => $startDate,
            'end_at' => $endDate,
            'time' => $time,
            'user_id' => $userId,
            'january' => $january,
            'february' => $february,
            'march' => $march,
            'april' => $april,
            'may' => $may,
            'june' => $june,
            'july' => $july,
            'august' => $august,
            'september' => $september,
            'october' => $october,
            'november' => $november,
            'december' => $december,
            'day1' => $day1,
            'day2' => $day2,
            'day3' => $day3,
            'day4' => $day4,
            'day5' => $day5,
            'day6' => $day6,
            'day7' => $day7,
            'day8' => $day8,
            'day9' => $day9,
            'day10' => $day10,
            'day11' => $day11,
            'day12' => $day12,
            'day13' => $day13,
            'day14' => $day14,
            'day15' => $day15,
            'day16' => $day16,
            'day17' => $day17,
            'day18' => $day18,
            'day19' => $day19,
            'day20' => $day20,
            'day21' => $day21,
            'day22' => $day22,
            'day23' => $day23,
            'day24' => $day24,
            'day25' => $day25,
            'day26' => $day26,
            'day27' => $day27,
            'day28' => $day28,
            'day29' => $day29,
            'day30' => $day30,
            'day31' => $day31
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
}
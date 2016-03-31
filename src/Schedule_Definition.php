<?php 
namespace SouhailMerroun\Schedulable;
   
use Illuminate\Database\Eloquent\Model as Eloquent;
use Auth;

class Schedule_Definition extends Eloquent
{
    protected $table = 'schedules_definitions';
    
    protected $fillable = [
		'schedulable_id', 'schedulable_type', 'user_id', 'type', 'date','start_at', 'end_at', 'time',

        'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday',
            
        'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december',
            
        'day1', 'day2', 'day3', 'day4', 'day5', 'day6', 'day7', 'day8', 'day9', 'day10', 'day11', 'day12', 'day13', 'day14', 'day15', 'day16', 'day17', 'day18', 'day19', 'day20', 'day21', 'day22', 'day23',
        'day24', 'day25', 'day26', 'day27', 'day28', 'day29', 'day30', 'day31',
	];
    
    public function schedulable()
	{
		return $this->morphTo();
	}
    
    public function schedules()
    {
        return $this->hasMany('SouhailMerroun\Schedulable\Schedule', 'schedule_id' ,'id');
    }
    
    public function scopeForLoggedInUser($query)
    {
        return $query->where('user_id', Auth::id());
    }
}       
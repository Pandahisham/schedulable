<?php 
namespace SouhailMerroun\Schedulable;
   
use Illuminate\Database\Eloquent\Model as Eloquent;
use Auth;
use Carbon\Carbon;

class Schedule extends Eloquent
{
    public $humanForDate;
    
    protected $fillable = [
        'schedulable_id',
        'schedulable_type',
        'schedule_definition_id',
        'user_id',
        'state', 
        'for_date', 
        'for_time', 
        'ended_at'
    ];
    
    public function schedulable()
    {
        return $this->morphTo();
    }
    
    public function schedule_definition()
    {
        return $this->belongsTo(Schedule_Definition::class);
    }
    
    public function scopeForLoggedInUser($query)
    {
        return $query->where('user_id', Auth::id());
    }
    
    public function getForTimeAttribute($value)
    {
        if($value == null)
            return;
        return Carbon::parse($value)->format('H:i');
    }
}       
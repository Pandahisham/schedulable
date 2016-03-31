<?php 
namespace SouhailMerroun\Schedulable;
   
use Illuminate\Database\Eloquent\Model as Eloquent;
use Auth;

class Schedule extends Eloquent
{
    protected $table = "schedules";
    
    protected $fillable = [
        'schedulable_id',
        'state', 
        'for_date', 
        'for_time', 
        'ended_at',
        'user_id'
    ];
    
    public function schedule_definition()
    {
        return $this->belongsTo('SouhailMerroun\Schedulable\Schedule_Definition');
    }
    
    public function scopeForLoggedInUser($query)
    {
        return $query->where('user_id', Auth::id());
    }
}       
Laravel 5.2 Schedulable Plugin
============

!! This is not a finished package, it still in the developement process, do not use it. !!


Trait for Laravel Eloquent models to allow easy implementation of scheduling feature.

### Composer Install (for Laravel 5.2)

    composer require souhailmerroun/schedulable "1.0.0"

### Install and then run the migrations

```php
'providers' => [
    ...
	SouhailMerroun\Schedulable\SchedulableServiceProvider::class
    ...
],
```

```bash
php artisan vendor:publish --provider="SouhailMerroun\Schedulable\SchedulableServiceProvider" --tag=migrations
php artisan migrate
```

### Setup your models, 
##### Example : Scheduling tasks.


```php
...
use SouhailMerroun\Schedulable\SchedulableTrait;

class Task extends Model {
	use SchedulableTrait;
}
```

### Sample Usage
#### Scheduling definition : Is where you put the definition of the schedule, for e.g i want this task to get repeated every day

##### Schedule once 
```php
$date_time = Carbon::create('2016', '03', '31', '17', '30'); //2016-03-31 17:30
$date = Carbon::create('2016', '04', '31'); 

$date_time = Carbon::create('2016', '03', '31', '17', '30'); //2016-03-31 17:30
        
//With date & time
$task->scheduleOnce($date_time->format('Y-m-d'), $date_time->format('H:i'));

//With date & time & user_id
$task->scheduleOnce($date_time->format('Y-m-d'), $date_time->format('H:i'), 3);

//With date & user_id
$task->scheduleOnce($date_time->format('Y-m-d'), null, 3);
```

##### Schedule every day 
```php
//With startDate, time, endDate, user_id
$task->scheduleEveryDay('2016-03-31', '18:00', '2016-04-30', 3);

//With startDate, time, user_id
$task->scheduleEveryDay('2016-03-31', null , '2016-04-30', 3);

//With startDate, user_id
$task->scheduleEveryDay('2016-03-31', null, null, 3);

//With startDate
$task->scheduleEveryDay('2016-03-31', null, null, null);
```

##### Schedule every giving day of the week
```php
//Choose days you want
$days = collect(['monday','tuesday','wednesday','thursday','friday','saturday','sunday']);

//Or ...

$days = collect(['saturday','sunday']);

//With startDate, time, endDate, user_id
$task->scheduleEveryGivingDayOfTheWeek('2016-03-31', '18:00', '2016-04-30', 3, $days);

//With startDate, time, user_id
$task->scheduleEveryGivingDayOfTheWeek('2016-03-31', null , '2016-04-30', 3, $days);

//With startDate, user_id
$task->scheduleEveryGivingDayOfTheWeek('2016-03-31', null, null, 3, $days);

//With startDate
$task->scheduleEveryGivingDayOfTheWeek('2016-03-31', null, null, null, $days);
```

##### Schedule every giving day of the month
```php
//Choose months and days you want
$months = collect(['january','march','april','june','september','november']);
$days = collect([1, 15]);


//With startDate, time, endDate, user_id
$task->scheduleEveryGivingDayOfTheMonth('2016-03-31', '18:00', '2016-04-30', 3, $days);

//With startDate, time, user_id
$task->scheduleEveryGivingDayOfTheMonth('2016-03-31', null , '2016-04-30', 3, $days);

//With startDate, user_id
$task->scheduleEveryGivingDayOfTheMonth('2016-03-31', null, null, 3, $days);

//With startDate
$task->scheduleEveryGivingDayOfTheMonth('2016-03-31', null, null, null, $days);
```

#### Scheduling data : Is where you get all your schedulings for a model

##### Get all schedules

```php
$task->schedules()->get(); //Return a collection of tasks

$task->schedules()->paginate(20); //Return with pagination
```

##### Get all pending schedules

```php
$task->getPendingSchedules(); //Return a collection of task schedules that are still waiting for action
```

##### Get all accomplished schedules

```php
$task->getAccomplishedSchedules(); //Return a collection of accomplished task schedules that are completed
```

##### Get all aborted schedules

```php
$task->getAbortedSchedules(); //Return a collection of aborted task schedules that are aborted
```

#### Credits

 - Souhail Merroun - http://souhailmerroun.com
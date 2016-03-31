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

##### Schedule every day 

```php
$task->scheduleOnce();
```

##### Schedule once 

```php
//The datetime must be a carbon instance
$datetime = Carbon::create('2016', '03', '31', '17', '30'); //2016-03-31 17:30


$task->scheduleOnce($datetime, $user_id);

//or

$task->scheduleOnce($datetime);

//or

$task->scheduleOnce(); //Take current datetime as default value
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
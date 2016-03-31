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


#### Credits

 - Souhail Merroun - http://souhailmerroun.com
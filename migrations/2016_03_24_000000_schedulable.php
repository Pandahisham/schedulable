<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Schedulable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //The schedules
        Schema::create('schedules_definitions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('schedulable_id')->unsigned();
			$table->string('schedulable_type');
			$table->integer('user_id')->unsigned();
                        
            $table->integer('type')->unsigned(); //0 once, 1 every day of the week, 2 every day of the month
            
            /* -- Used only for type 0 -- */
            $table->date('date')->nullable();
            /* Used for type 0 */
            
            /* -- Used for type 1 or 2 -- */
            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();
            /* -- Used for type 1 or 2 -- */
            
            $table->time('time')->nullable(); //Used the specified if the time is fixed
            
            $table->boolean('monday')->nullable();
            $table->boolean('tuesday')->nullable();
            $table->boolean('wednesday')->nullable();
            $table->boolean('thursday')->nullable();
            $table->boolean('friday')->nullable();
            $table->boolean('saturday')->nullable();
            $table->boolean('sunday')->nullable();
            
            $table->boolean('january')->nullable();
            $table->boolean('february')->nullable();
            $table->boolean('march')->nullable();
            $table->boolean('april')->nullable();
            $table->boolean('may')->nullable();
            $table->boolean('june')->nullable();
            $table->boolean('july')->nullable();
            $table->boolean('august')->nullable();
            $table->boolean('september')->nullable();
            $table->boolean('october')->nullable();
            $table->boolean('november')->nullable();
            $table->boolean('december')->nullable();
            
            $table->boolean('day1')->nullable();
            $table->boolean('day2')->nullable();
            $table->boolean('day3')->nullable();
            $table->boolean('day4')->nullable();
            $table->boolean('day5')->nullable();
            $table->boolean('day6')->nullable();
            $table->boolean('day7')->nullable();
            $table->boolean('day8')->nullable();
            $table->boolean('day9')->nullable();
            $table->boolean('day10')->nullable();
            $table->boolean('day11')->nullable();
            $table->boolean('day12')->nullable();
            $table->boolean('day13')->nullable();
            $table->boolean('day14')->nullable();
            $table->boolean('day15')->nullable();
            $table->boolean('day16')->nullable();
            $table->boolean('day17')->nullable();
            $table->boolean('day18')->nullable();
            $table->boolean('day19')->nullable();
            $table->boolean('day20')->nullable();
            $table->boolean('day21')->nullable();
            $table->boolean('day22')->nullable();
            $table->boolean('day23')->nullable();
            $table->boolean('day24')->nullable();
            $table->boolean('day25')->nullable();
            $table->boolean('day26')->nullable();
            $table->boolean('day27')->nullable();
            $table->boolean('day28')->nullable();
            $table->boolean('day29')->nullable();
            $table->boolean('day30')->nullable();
            $table->boolean('day31')->nullable();
            
			$table->timestamps();
		});
        
        Schema::create('schedules', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('schedulable_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
			$table->integer('schedule_id')->unsigned();
            $table->foreign('schedule_id')->references('id')->on('schedules');
            $table->boolean('state')->nullable(); //-1 Aborted, 1 accomplished
            $table->date('for_date')->nullable();
            $table->time('for_time')->nullable();
            $table->date('ended_at')->nullable(); // Store the date if abandonned or accomplished 
			$table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schedules');
    }
}

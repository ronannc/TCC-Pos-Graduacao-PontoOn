<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegisterPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_points', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->integer('type')->nullable();
            $table->integer('overtime')->nullable();
            $table->integer('type_overtime')->nullable();
            $table->integer('minutes_worked')->nullable();
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->timestamps();
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('datetime',6)->nullable();
            $table->unsignedInteger('point_id');
            $table->foreign('point_id')->references('id')->on('register_points');
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
        //
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BankHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_hours', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->timestamps();
        });

        Schema::create('bank_hours_details', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->unsignedInteger('point_id');
            $table->foreign('point_id')->references('id')->on('register_points');
            $table->unsignedInteger('minutes');
            $table->integer('type_overtime');
            $table->unsignedInteger('bank_id');
            $table->foreign('bank_id')->references('id')->on('bank_hours');
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

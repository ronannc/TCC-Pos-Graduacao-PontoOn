<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TimeTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_tables_description', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->timestamps();
        });

        Schema::create('time_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('day');
            $table->time('first_entry');
            $table->time('first_exit');
            $table->time('second_entry');
            $table->time('second_exit');
            $table->time('third_entry');
            $table->time('third_exit');
            $table->time('quantity_hours_day');
            $table->unsignedInteger('time_table_id');
            $table->foreign('time_table_id')->references('id')->on('time_tables_description');
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

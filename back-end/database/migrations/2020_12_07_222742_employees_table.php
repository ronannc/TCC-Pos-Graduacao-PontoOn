<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('salary')->nullable();
            $table->string('name', 100);
            $table->date('date_admission');
            $table->date('date_resignation')->nullable();
            $table->string('mother_name',100)->nullable();
            $table->string('cpf',15)->nullable();
            $table->string('email',200)->nullable();
            $table->string('telephone',30)->nullable();
            $table->unsignedInteger('time_table_id');
            $table->foreign('time_table_id')->references('id')->on('time_tables_description');
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedInteger('syndicate_id')->nullable();
            $table->foreign('syndicate_id')->references('id')->on('syndicates');
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
        Schema::dropIfExists('employees');
    }
}

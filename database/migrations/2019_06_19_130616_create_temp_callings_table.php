<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempCallingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_callings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('employee_id');
            $table->integer("number");
            $table->integer("window");
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('restrict')->onUpdate('restrict');

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
        
        Schema::dropIfExists('temp_callings');
    }
}

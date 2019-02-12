<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchServiceServiceEmloyeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_service_service_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('branch_service_id');
            $table->unsignedInteger('serviceEmployee_id');
            $table->integer("timeAverage");

            $table->foreign('branch_service_id')->references('id')->on('branch_services')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('serviceEmployee_id')->references('id')->on('service_employees')->onDelete('restrict')->onUpdate('restrict');


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
        Schema::dropIfExists('branch_service_service_emloyees');
    }
}

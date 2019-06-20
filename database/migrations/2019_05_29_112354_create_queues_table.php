<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("number");
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();

            $table->integer("priority");
            $table->time("start_served")->nullable();
            $table->time("end_served")->nullable();

            $table->foreign('service_id')->references('id')->on('services')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('queues');
    }
}

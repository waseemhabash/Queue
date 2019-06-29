<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{

    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('user_id');

            $table->string("name");
            $table->string("address");

            $table->double("lng");
            $table->double("lat");

            $table->time("open_time");
            $table->time("close_time");
            $table->integer("minutes_before_closing");

            $table->string("image");

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('restrict')->onUpdate('restrict');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('branches');
    }
}

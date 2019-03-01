<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{

    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('branch_manger_id');

            $table->string("name");
            $table->text("description");
            $table->string("address");

            $table->double("lng");
            $table->double("lat");

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('branch_manger_id')->references('id')->on('branch_mangers')->onDelete('restrict')->onUpdate('restrict');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('branches');
    }
}

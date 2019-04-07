<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobcareersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobcareers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('gender');
            $table->date('senddate');
            $table->longText('remark');
            $table->integer('status');

            //company
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');

            //position
            $table->unsignedBigInteger('position_id');
            $table->foreign('position_id')->references('id')->on('positions');


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
        Schema::dropIfExists('jobcareers');
    }
}

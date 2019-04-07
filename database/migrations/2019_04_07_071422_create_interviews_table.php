<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('appointment');
            $table->longText('remark');
            $table->string('status');

            //student
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students');

            //jobareer
            $table->unsignedBigInteger('jobcareer_id');
            $table->foreign('jobcareer_id')->references('id')->on('jobcareers');

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
        Schema::dropIfExists('interviews');
    }
}

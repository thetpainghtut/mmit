<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInquiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('gender');
            $table->date('dob');
            $table->string('age');
            $table->longText('address');
            $table->string('phno');
            $table->string('email');
            $table->string('installmentdate');
            $table->string('installmentamount');
            $table->longText('remark');
            $table->string('position');
            $table->string('camp');
            $table->string('education');
            $table->string('acceptedyear');

            //section
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections');

            //township
            $table->unsignedBigInteger('township_id');
            $table->foreign('township_id')->references('id')->on('townships');

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
        Schema::dropIfExists('inquires');
    }
}

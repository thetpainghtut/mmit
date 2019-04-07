<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDismissesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dismisses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('remark');


            //interview
            $table->unsignedBigInteger('interview_id');
            $table->foreign('interview_id')->references('id')->on('interviews');

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
        Schema::dropIfExists('dismisses');
    }
}

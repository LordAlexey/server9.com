<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventAttendeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_attendee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('events');
            $table->bigInteger('attendee_id')->unsigned();
            $table->foreign('attendee_id')->references('id')->on('attendees');
            $table->enum('registration_type',['early_bird','general','vip']);
            $table->dateTime('registration_date',['early_bird','general','vip']);
            $table->float('calculated_price')->unsigned();
            $table->enum('event_rating',[0,1,2])->nullable();
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
        Schema::dropIfExists('event_attendee');
    }
}

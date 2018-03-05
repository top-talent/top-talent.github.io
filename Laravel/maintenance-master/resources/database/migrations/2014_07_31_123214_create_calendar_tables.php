<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCalendarTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('location_id')->unsigned()->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('api_calendar_id');
            $table->string('api_id');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('set null');

            $table->foreign('location_id')->references('id')->on('locations')
                ->onUpdate('restrict')
                ->onDelete('set null');

            $table->foreign('parent_id')->references('id')->on('events')
                ->onUpdate('restrict')
                ->onDelete('set null');
        });

        Schema::create('eventables', function (Blueprint $table) {
            $table->integer('event_id')->unsigned();
            $table->integer('eventable_id');
            $table->string('eventable_type');

            $table->foreign('event_id')->references('id')->on('events')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });

        Schema::create('event_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('event_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->text('description');

            $table->foreign('event_id')->references('id')->on('events')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('event_reports');
        Schema::drop('eventables');
        Schema::drop('events');
    }
}

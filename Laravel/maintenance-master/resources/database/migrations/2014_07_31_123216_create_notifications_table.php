<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('notifiable_id');
            $table->string('notifiable_type');
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('read')->default(0);
            $table->string('message');
            $table->string('link');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('notifications');
    }
}

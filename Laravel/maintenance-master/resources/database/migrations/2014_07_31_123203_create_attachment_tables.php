<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttachmentTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {

            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('file_name');
            $table->text('file_path');

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
        Schema::drop('attachments');
    }
}

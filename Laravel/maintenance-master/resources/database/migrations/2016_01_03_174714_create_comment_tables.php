<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->string('title')->nullable()->default(null);
            $table->text('description');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });

        Schema::create('work_order_comments', function (Blueprint $table) {
            $table->integer('comment_id')->unsigned();
            $table->integer('work_order_id')->unsigned();

            $table->foreign('comment_id')->references('id')->on('comments')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('work_order_id')->references('id')->on('work_orders')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });

        Schema::create('work_request_comments', function (Blueprint $table) {
            $table->integer('comment_id')->unsigned();
            $table->integer('work_request_id')->unsigned();

            $table->foreign('comment_id')->references('id')->on('comments')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('work_request_id')->references('id')->on('work_requests')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('work_order_comments');
        Schema::drop('work_request_comments');
        Schema::drop('comments');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkOrderTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('work_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('subject');
            $table->text('description');
            $table->string('best_time');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('set null');
        });

        Schema::create('work_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('location_id')->unsigned()->nullable();
            $table->integer('request_id')->unsigned()->nullable();
            $table->integer('status_id')->unsigned();
            $table->integer('priority_id')->unsigned();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->string('subject');
            $table->text('description')->nullable();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('set null');

            $table->foreign('location_id')->references('id')->on('locations')
                ->onUpdate('restrict')
                ->onDelete('set null');

            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('restrict')
                ->onDelete('set null');

            $table->foreign('request_id')->references('id')->on('work_requests')
                ->onUpdate('restrict')
                ->onDelete('set null');

            $table->foreign('status_id')->references('id')->on('statuses')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('priority_id')->references('id')->on('priorities')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            /*
             * Allow only one work request to be attached per work order
             *
             * Possible incompatibility with SQL Server
             */
            $table->unique(['request_id']);
        });

        Schema::create('work_order_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->integer('work_order_id')->unsigned();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('priority')->default(0);
            $table->tinyInteger('parts')->default(0);
            $table->tinyInteger('customer_updates')->default(0);
            $table->tinyInteger('technician_updates')->default(0);
            $table->tinyInteger('completion_report')->default(0);

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('work_order_id')->references('id')->on('work_orders')
                ->onUpdate('restrict')
                ->onDelete('cascade');

        });

        Schema::create('work_order_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->integer('work_order_id')->unsigned();
            $table->text('description');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('work_order_id')->references('id')->on('work_orders')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });

        Schema::create('work_order_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->integer('work_order_id')->unsigned();
            $table->dateTime('in');
            $table->dateTime('out')->nullable();
            $table->decimal('hours', 5, 2)->nullable(); //Over-ride hours

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('work_order_id')->references('id')->on('work_orders')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });

        Schema::create('work_order_attachments', function (Blueprint $table) {
            $table->integer('work_order_id')->unsigned();
            $table->integer('attachment_id')->unsigned();

            $table->foreign('work_order_id')->references('id')->on('work_orders')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('attachment_id')->references('id')->on('attachments')
                ->onUpdate('restrict')
                ->onDelete('cascade');

        });

        Schema::create('work_order_assets', function (Blueprint $table) {
            $table->integer('work_order_id')->unsigned();
            $table->integer('asset_id')->unsigned();

            $table->foreign('work_order_id')->references('id')->on('work_orders')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('asset_id')->references('id')->on('assets')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });

        Schema::create('work_order_parts', function (Blueprint $table) {
            $table->timestamps();
            $table->integer('work_order_id')->unsigned();
            $table->integer('stock_id')->unsigned();
            $table->decimal('quantity', 8, 2);

            $table->foreign('work_order_id')->references('id')->on('work_orders')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('stock_id')->references('id')->on('inventory_stocks')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });

        Schema::create('work_order_assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('work_order_id')->unsigned();
            $table->integer('by_user_id')->unsigned();
            $table->integer('to_user_id')->unsigned();

            $table->foreign('work_order_id')->references('id')->on('work_orders')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('by_user_id')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('to_user_id')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('work_order_assignments');
        Schema::drop('work_order_parts');
        Schema::drop('work_order_assets');
        Schema::drop('work_order_attachments');
        Schema::drop('work_order_sessions');
        Schema::drop('work_order_reports');
        Schema::drop('work_order_notifications');
        Schema::drop('work_orders');
        Schema::drop('work_requests');
    }
}

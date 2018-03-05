<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->date('acquired_at')->nullable();
            $table->date('end_of_life')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('location_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned();
            $table->string('tag')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('condition')->nullable();
            $table->string('size')->nullable();
            $table->string('weight')->nullable();
            $table->string('vendor')->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('serial')->nullable();
            $table->decimal('price', 10, 2)->nullable();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('set null');

            $table->foreign('location_id')->references('id')->on('locations')
                ->onUpdate('restrict')
                ->onDelete('set null');

            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });

        Schema::create('asset_meters', function (Blueprint $table) {
            $table->integer('asset_id')->unsigned();
            $table->integer('meter_id')->unsigned();

            $table->foreign('asset_id')->references('id')->on('assets')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('meter_id')->references('id')->on('meters')
                ->onUpdate('restrict')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('asset_meters');
        Schema::drop('assets');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetManualsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('asset_manuals', function (Blueprint $table) {
            $table->integer('asset_id')->unsigned();
            $table->integer('attachment_id')->unsigned();

            $table->foreign('asset_id')->references('id')->on('assets')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('attachment_id')->references('id')->on('attachments')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });

        Schema::create('asset_images', function (Blueprint $table) {
            $table->integer('asset_id')->unsigned();
            $table->integer('attachment_id')->unsigned();

            $table->foreign('asset_id')->references('id')->on('assets')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('attachment_id')->references('id')->on('attachments')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('asset_images');
        Schema::drop('asset_manuals');
    }
}

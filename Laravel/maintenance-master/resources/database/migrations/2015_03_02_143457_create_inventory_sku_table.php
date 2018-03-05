<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventorySkuTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inventory_skus', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('inventory_id')->unsigned();
            $table->string('code');

            $table->foreign('inventory_id')->references('id')->on('inventories')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            /*
             * Make sure each SKU is unique
             */
            $table->unique(['code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('inventory_skus');
    }
}

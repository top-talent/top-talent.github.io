<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ModifyInventoryTableForAssemblies extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->boolean('is_assembly')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn('is_assembly');
        });
    }
}

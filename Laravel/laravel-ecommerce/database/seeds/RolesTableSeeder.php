<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('roles')->delete();

    	$roles = [
            ['name'  => 'Administrator'],
    		['name'  => 'Client'],
    	];

    	DB::table('roles')->insert($roles);
    }
}

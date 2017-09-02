<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
        		[
        			'name' => 'author',
        			'description' => 'Someone who\'s access is to create content.'
        		],
        		[
        			'name' => 'administrator',
        			'description' => 'Have all the access to every function on this app.'
        		]
        	]);
    }
}

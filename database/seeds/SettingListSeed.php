<?php

use Illuminate\Database\Seeder;

class SettingListSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seettinglist')->insert([
        		[
        			'name' => 'app'
        		]
        	]);
    }
}

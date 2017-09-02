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
        DB::table('settinglist')->insert([
        		[
                    'name' => 'app',
                    'value' => 'Application'
                ],[
        			'name' => 'user',
        			'value' => 'User'
        		]
        	]);
    }
}

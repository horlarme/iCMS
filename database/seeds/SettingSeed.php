<?php

use Illuminate\Database\Seeder;

class SettingSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appsetting')->insert([
            [
                'setting_id' => DB::table('settinglist')->where('name','app')->first()->id,
                'name' => 'name',
                'value' => 'Simply'
            ],
            [
                'setting_id' => DB::table('settinglist')->where('name','app')->first()->id,
                'name' => 'user.register',
                'value' => 'true'
            ]
        ]);
    }
}

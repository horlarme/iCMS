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
                'setting_id' => 1,
                'name' => 'name',
                'value' => 'Simply'
            ],
            [
                'setting_id' => 1,
                'name' => 'user.register',
                'value' => 'true'
            ]
        ]);
    }
}

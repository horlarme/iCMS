<?php

use Illuminate\Database\Seeder;

class Role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([[
            'name' => 'Author',
            'description' => 'Someone who\'s access is to create content.'
        ], [
            'name' => 'Administrator',
            'description' => 'Have all the access to every function on this app.'
        ]]);
    }
}

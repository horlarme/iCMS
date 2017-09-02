<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([[
            'name' => 'Undefined',
            'title' => 'Doesn\'t hold any category',
            'icon' => 'fi-wrench'
        ]]);
    }
}

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
            'title' => 'Doesn\'s hold any category',
            'icon' => 'fi-wrench'
        ],[
            'name' => 'Security',
            'title' => 'Protect your device and self with security tips and helps.',
            'icon' => 'fi-wrench'
        ], [
            'name' => 'Apps',
            'title' => 'Software and Application related stuffs.',
            'icon' => 'fi-social-apple'
        ], [
            'name' => 'Mobile',
            'title' => 'Your phone Information and latest tricks',
            'icon' => 'fi-tablet-portrait'
        ], [
            'name' => 'Experiences',
            'title' => 'Read about other developers/programmers\' stories and experiences in the industry.',
            'icon' => 'fi-shuffle'
        ], [
            'name' => 'Others',
            'title' => 'I can\'t find a place for these!!!',
            'icon' => 'fi-database'
        ], [
            'name' => 'Internet',
            'title' => 'Internet and its stuffs.',
            'icon' => 'fi-web'
        ]]);
    }
}

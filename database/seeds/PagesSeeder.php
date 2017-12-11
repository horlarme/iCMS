<?php

use Illuminate\Database\Seeder;
use App\Pages;
use App\User;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pages::insert([
        	[
        		'title' => 'About Us',
        		'author' => User::first()->id,
        	],
        	[
        		'title' => 'Contact Us',
        		'author' => User::first()->id,
        	]
        ]);
    }
}

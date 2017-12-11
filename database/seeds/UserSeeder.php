<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User Class 
        $user = new User();
        //Variable storing the default image to be used for the user based on their gender
        $image = $user->assignImage('male');
        $user = User::create([
            'first_name' => 'first name',
            'last_name' => 'last name',
            'mobile' => '01234567890',
            'website' => 'website.com',
            'email' => 'email@example.com',
            'gender' => 'male',
            'image' => $image,
            'password' => bcrypt('password'),
        ]);

        /**
         * Assign a role to the user trying to register
         */
        userRole($user->id, Role::where('name', 'administrator')->first()->id);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CategorySeeder::class);
         $this->call(RoleSeed::class);
         $this->call(SettingListSeed::class);
         $this->call(SettingSeed::class);
         $this->call(UserSeeder::class);
         $this->call(PagesSeeder::class);
    }
}

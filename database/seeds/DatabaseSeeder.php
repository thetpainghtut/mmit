<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        // $this->call(UsersTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
=======
        $this->call(UsersTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(TownshipsTableSeeder::class);

>>>>>>> da7f1a7e015a3c583f1f23e8ff3e66c9cc1347f3
    }
}

<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Yangon
        DB::table('cities')->insert([
            'name' => 'Yangon',
            'created_at' => now(),
	        'updated_at' => now()
        ]);

        //Mandalay
        DB::table('cities')->insert([
            'name' => 'Mandalay',
            'created_at' => now(),
	        'updated_at' => now()
        ]);
    }
}

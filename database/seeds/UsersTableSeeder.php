<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Yin Min Ei
        DB::table('users')->insert([
            'name' 		 => 'Yin Min Ei',
            'email'		 =>	'yinmiei@gmail.com',
            'password'	 => Hash::make('1234567'),
            'created_at' => now(),
	        'updated_at' => now()
        ]);

        //Aye Chan Khin
        DB::table('users')->insert([
            'name' 		 => 'Aye Chan Khin',
            'email'		 =>	'ayechankhin@gmail.com',
            'password'	 => Hash::make('1234567'),
            'created_at' => now(),
	        'updated_at' => now()
        ]);

        //Ei Mar Win
        DB::table('users')->insert([
            'name' 		 => 'Ei Mar Win',
            'email'		 =>	'yinmiei@gmail.com',
            'password'	 => Hash::make('1234567'),
            'created_at' => now(),
	        'updated_at' => now()
        ]);
    }
}

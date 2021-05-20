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
        DB::table('users')->insert([
            'name' => 'AdminShop',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '01680800810',
            'address' => 'Dhaka',
            'is_admin' => '1',
            'created_at' => now(),
            'updated_at' => now()
            
        ]);

        DB::table('users')->insert([
            'name' => 'AdminOceanta',
            'email' => 'oceanta.fashion@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '01680800810',
            'address' => 'Dhaka',
            'is_admin' => '1',
            'created_at' => now(),
            'updated_at' => now()
            
        ]);
    }
}

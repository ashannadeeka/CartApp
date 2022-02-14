<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_registers')->truncate();

        DB::table('user_registers')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Ashan',
            'dob' => '1995-01-11',
            'gender' => 'male',
            'email' => 'admin123@gmail.com',
            'contact_number' => '0711111111',
            'password' => bcrypt('123456'),
            'role' => '0',
        ]);
    }
}

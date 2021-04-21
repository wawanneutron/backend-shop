<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin Toko E-commerce',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
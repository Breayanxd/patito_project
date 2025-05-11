<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Carlos Sánchez Salazar',
            'email'=>'carlos@email.com',
            'password'=>Hash::make('password123'),
            'status'=>'Active',
            'last_login'=>now(),
        ]);
    }
}

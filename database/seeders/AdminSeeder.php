<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'store@centralshop.cl'],
            [
                'name'     => 'Administrador',
                'password' => Hash::make('Admin2024!'),
            ]
        );
    }
}

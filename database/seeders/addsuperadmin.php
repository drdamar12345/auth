<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class addsuperadmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('users')->insert([
            [
                'name' => 'super admin',
                'email' => 'superadmin@gmail.com',
                'password' => '$2y$10$b5LYHcTxgETTtZ1SHlqfUewgDk4nT5B4f82ak1Ld/LsOoIhMyevPu',
                'is_superadmin' => 'superadmin',
            ],
        ]);
    }
}

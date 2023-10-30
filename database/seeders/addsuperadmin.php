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
                'name' => 'damar',
                'email' => 'triplewar4@gmail.com',
                'password' => '$2a$12$PT9hq0Wu9K6zwn3HOmkZeO8b5ZMq5SKu8Ezx09Ye1MYDAGrR1SU7.',
                'is_superadmin' => 'super_admin',
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('users')->insert([
            'name' => 'Tanu Wijaya',
            'email' => 'tanu@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
            'phone' => '082212344321',
            'address' => 'Jl. Raya Cibinong No. 123 Cibinong Cimahi Indonesia',
            'created_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Septi Hanafi',
            'email' => 'septi@gmail.com',
            'password' => Hash::make('password'),
            // 'password' => bcrypt('password'),
            'role' => 'admin',
            'phone' => '082243211234',
            'address' => 'Jl. Raya Cibinong No. 123 Cibinong Cimahi Indonesia',
            'created_at' => now(),
        ]);
    }
}

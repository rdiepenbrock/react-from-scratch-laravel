<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'rjdwebsites@gmail.com'],
            [
                'name' => 'R.J. Diepenbrock',
                'password' => Hash::make('rjdWebs!tes2023'),
                'email_verified_at' => now(),
            ]
        );

        $this->call(PuppySeeder::class);
    }
}

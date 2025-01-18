<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\BookSeeder;
use Database\Seeders\AuthorSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\LoanSeeder;
use Database\Seeders\EmployeeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AuthorSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(UserSeeder::class);
        //$this->call(EmployeeSeeder::class);
        $this->call(LoanSeeder::class);
    }
}

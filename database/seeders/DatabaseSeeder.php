<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
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

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'admin1234',
            'is_employee' => true,
            'is_admin' => true
        ]);
        User::factory()->create([
            'name' => 'Employee',
            'email' => 'employee@example.com',
            'password' => 'employee1234',
            'is_employee' => true,
            'is_admin' => false
        ]);
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => 'user1234',
            'is_employee' => false,
            'is_admin' => false
        ]);
        $this->call(AuthorSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(LoanSeeder::class);
    }
}

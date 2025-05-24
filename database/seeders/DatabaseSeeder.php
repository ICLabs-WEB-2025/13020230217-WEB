<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Role::firstOrCreate(['name' => 'admin']);

            $admin= User::updateOrCreate([
            ['email' => 'admin@lapanganku.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        $admin->assignRole('admin');
    }
}

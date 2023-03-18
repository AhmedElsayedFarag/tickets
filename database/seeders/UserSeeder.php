<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'first_name' => 'ahmed',
            'last_name' => 'farag',
            'email' => 'admin@admin.com',
            'phone' => '01061756297',
            'email_verified_at' => now(),
            'password' => '123456789',
        ])->each(function ($user) {
            $user->assignRole('admin');
        });

        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('employee');
        });
    }
}

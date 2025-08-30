<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $managerRole = Role::where('name', UserRoleEnum::MANAGER->value)->first();
        $userRole = Role::where('name', UserRoleEnum::USER->value)->first();

        User::firstOrCreate(
['email' => 'manager@example.com'],
    [
                'name' => 'Manager',
                'password' => Hash::make('password'),
                'role_id' => $managerRole->id,
            ]
        );

        $i = 1;
        while($i <= 5){
            User::firstOrCreate(
    ['email' => "user{$i}@example.com"],
        [
                    'name' => "User {$i}",
                    'password' => Hash::make('password'),
                    'role_id' => $userRole->id,
                ]
            );
            $i++;
        }
    }
}

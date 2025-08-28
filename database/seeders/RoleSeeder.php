<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(UserRoleEnum::values() as $value){
            Role::create(['name' => $value]);
        }
        // DB::table('roles')->insert([
        //     ['name' => UserRoleEnum::MANAGER, 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => UserRoleEnum::USER, 'created_at' => now(), 'updated_at' => now()],
        // ]);
    }
}

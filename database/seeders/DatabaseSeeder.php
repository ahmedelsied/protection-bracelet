<?php

namespace Database\Seeders;

use App\Domain\Management\Models\User;
use HsmFawaz\UI\Services\RolesAndPermissions\RolesEnum;
use HsmFawaz\UI\Services\RolesAndPermissions\RolesSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->setupUsers();
        $this->call(BraceletSeeder::class);
    }

    private function setupUsers()
    {
        User::updateOrCreate(['phone' => 'admin'], [
            'name' => 'Administrator',
            'password' => Hash::make('123456'),
        ])->assignRole(RolesEnum::super()->value);
        echo 'Admins Created Successfully'.PHP_EOL;
    }
}

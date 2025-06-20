<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Deepak Morya',
            'email' => 'helodeepakji@gmail.com',
            'gender' => 'male',
            'phone' => '8076763204',
            'role_id' => 1,
            'profile' => '',
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now(),
            'is_team_leader' => 0
        ]);
    }
}

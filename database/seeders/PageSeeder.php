<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $pages = [
            ['id' => 1, 'name' => 'Team Management', 'slug' => 'team-management'],
            ['id' => 2, 'name' => 'Permission', 'slug' => 'permission'],
            ['id' => 3, 'name' => 'Team List', 'slug' => 'team-list'],
            ['id' => 4, 'name' => 'Create Team', 'slug' => 'create-team'],
            ['id' => 5, 'name' => 'Team Action', 'slug' => 'team-action'],
            ['id' => 6, 'name' => 'Role List', 'slug' => 'role-list'],
            ['id' => 7, 'name' => 'Role Action', 'slug' => 'role-action'],
            ['id' => 8, 'name' => 'Create Role', 'slug' => 'create-role'],
            ['id' => 9, 'name' => 'User List', 'slug' => 'user-list'],
            ['id' => 10, 'name' => 'User Action', 'slug' => 'user-action'],
            ['id' => 11, 'name' => 'Create User', 'slug' => 'create-user'],
            ['id' => 12, 'name' => 'Team User List', 'slug' => 'team-user-list'],
            ['id' => 13, 'name' => 'Survey Question Action', 'slug' => 'survey-question-action'],
            ['id' => 14, 'name' => 'Survey Question', 'slug' => 'survey-question'],
        ];

        foreach ($pages as $page) {
            DB::table('pages')->insert([
                ...$page,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'admin-list',
            'admin-create',
            'admin-edit',
            'admin-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'event-list',
            'event-create',
            'event-edit',
            'event-delete',
            'place-list',
            'place-create',
            'place-edit',
            'place-delete',
            'tourist-list',
            'tourist-create',
            'tourist-edit',
            'tourist-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'question-list',
            'question-create',
            'question-edit',
            'question-delete',
            'option-list',
            'option-create',
            'option-edit',
            'option-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

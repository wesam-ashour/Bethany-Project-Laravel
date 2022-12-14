<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'Wesam',
            'mobile' => '0599999999',
            'email' => 'admin@admin.com',
            'user_name' => 'admin',
            'address' => 'gaza',
            'password' => bcrypt('password'),
            'image' => 'main.jpg',
        ]);
        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $admin->assignRole([$role->id]);

        $user = User::create([
            'full_name' => 'Ahmed',
            'mobile' => '0599999999',
            'email' => 'user1@user1.com',
            'user_name' => 'edfdf',
            'address' => 'gaza',
            'created_at' => '2022-12-11 13:24:42',
        ]);
        $user = User::create([
            'full_name' => 'Wesam',
            'mobile' => '05999222999',
            'email' => 'user2@user2.com',
            'user_name' => 'fdvfd',
            'address' => 'gaza',
            'created_at' => '2022-12-11 13:24:42',
        ]);
        $user = User::create([
            'full_name' => 'Ali',
            'mobile' => '059332999999',
            'email' => 'user3@user3.com',
            'user_name' => 'sdfdssdf',
            'address' => 'gaza',
            'created_at' => '2022-12-11 13:24:42',
        ]);
        $user = User::create([
            'full_name' => 'Mohammed',
            'mobile' => '05999434999',
            'email' => 'user4@user4.com',
            'user_name' => 'fedfe',
            'address' => 'gaza',
            'created_at' => '2022-12-11 13:24:42',
        ]);
        $user = User::create([
            'full_name' => 'Bad',
            'mobile' => '059329999',
            'email' => 'user5@user5.com',
            'user_name' => 'dsfdsfds',
            'address' => 'gaza',
            'created_at' => '2022-12-11 13:24:42',
        ]);




    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Schema;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();
        $permissions = [
            ['group'=> 'settings', 'name' => 'view_settings', 'guard_name' => 'web'],
            ['group'=> 'settings', 'name' => 'edit_settings', 'guard_name' => 'web'],
            
            //Plans
            ['group'=> 'plans', 'name' => 'view_plans', 'guard_name' => 'web'],
            ['group'=> 'plans', 'name' => 'create_plans', 'guard_name' => 'web'],
            ['group'=> 'plans', 'name' => 'edit_plans', 'guard_name' => 'web'],
            ['group'=> 'plans', 'name' => 'delete_plans', 'guard_name' => 'web'],

            //view_permissions
            ['group'=> 'permissions', 'name' => 'view_permissions', 'guard_name' => 'web'],
            ['group'=> 'permissions', 'name' => 'edit_permissions', 'guard_name' => 'web'],
            
            //Roles
            ['group'=> 'roles', 'name' => 'view_roles', 'guard_name' => 'web'],
            ['group'=> 'roles', 'name' => 'edit_roles', 'guard_name' => 'web'],
            ['group'=> 'roles', 'name' => 'create_roles', 'guard_name' => 'web'],
            ['group'=> 'roles', 'name' => 'delete_roles', 'guard_name' => 'web'],

            //Administrator
            ['group'=> 'administrators', 'name' => 'view_administrators', 'guard_name' => 'web'],
            ['group'=> 'administrators', 'name' => 'edit_administrators', 'guard_name' => 'web'],
            ['group'=> 'administrators', 'name' => 'create_administrators', 'guard_name' => 'web'],
            ['group'=> 'administrators', 'name' => 'delete_administrators', 'guard_name' => 'web'],
            //Users
            ['group'=> 'users', 'name' => 'view_users', 'guard_name' => 'web'],
            ['group'=> 'users', 'name' => 'edit_users', 'guard_name' => 'web'],
            ['group'=> 'users', 'name' => 'create_users', 'guard_name' => 'web'],
            ['group'=> 'users', 'name' => 'delete_users', 'guard_name' => 'web'],
            //Referral commission
            ['group'=> 'commission', 'name' => 'view_commission', 'guard_name' => 'web'],
            ['group'=> 'commission', 'name' => 'edit_commission', 'guard_name' => 'web'],
            ['group'=> 'commission', 'name' => 'create_commission', 'guard_name' => 'web'],
            ['group'=> 'commission', 'name' => 'delete_commission', 'guard_name' => 'web'],
            //Referral commission
            ['group'=> 'reward', 'name' => 'view_reward', 'guard_name' => 'web'],
            ['group'=> 'reward', 'name' => 'edit_reward', 'guard_name' => 'web'],
            ['group'=> 'reward', 'name' => 'create_reward', 'guard_name' => 'web'],
            ['group'=> 'reward', 'name' => 'delete_reward', 'guard_name' => 'web'],

        ];

        Permission::insert($permissions);

         //Admin
        $admin = Role::updateOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminPermissions = Permission::get();
        $admin->permissions()->sync($adminPermissions->pluck('id'));
 
         //staff
        $staff = Role::updateOrCreate(['name' => 'staff', 'guard_name' => 'web']);
        $staffPermissions = Permission::whereNotIn('group', [
            'administrators',
             'settings'
            ])->get();
        $staff->permissions()->sync($staffPermissions->pluck('id'));

        $user = Role::updateOrCreate(['name' => 'user', 'guard_name' => 'web']);
         
    }
}

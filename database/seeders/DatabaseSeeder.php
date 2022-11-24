<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use App\Models\Plan;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesAndPermissionSeeder::class,
            GeneralSettingsSeeder::class,
            PlanSeeder::class,
            PlanLevelSeeder::class,
            RewardSeeder::class,
            UserTableSeeder::class,
        ]);
        
        if(env('APP_ENV') == 'local'){
            \App\Models\User::factory(200)->create();
            $this->call([
                UserLoginSeeder::class,
            ]);
        }

        //Admin Roles
        $admins = User::where('user_type', 'admin')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->users()->sync($admins->id);
        //Staff Role
        $staffs = User::where('user_type', 'staff')->get();
        $staffRole = Role::where('name', 'staff')->first();
        $staffRole->users()->sync($staffs->pluck('id'));
        //User Role
        $users = User::where('user_type', 'user')->get();
        $userRole = Role::where('name', 'user')->first();
        $userRole->users()->sync($users->pluck('id'));

    }
}

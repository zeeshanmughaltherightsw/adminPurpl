<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $admin = User::updateOrCreate([
            'username' => 'admin',
            'email' => 'admin@stonearn.com',
        ],[
            'name' => 'Admin',
            'password' => Hash::make('12345678'),
            'user_type' => 'admin',
            'email_verified_at' => Carbon::now()
        ]);

        $staff = User::updateOrCreate([
            'username' => 'staff',
            'email' => 'staff@stonearn.com',
        ],[
            'name' => 'staff',
            'password' => Hash::make('12345678'),
            'user_type' => 'staff',
            'email_verified_at' => Carbon::now()
        ]);

        $user = User::updateOrCreate([
            'username' => 'user',
            'email' => 'user@stonearn.com',
        ],[
            'name' => 'User',
            'password' => Hash::make('12345678'),
            'user_type' => 'user',
            'email_verified_at' => Carbon::now(),
            'plan_id' => '1',
            'investment' => env('APP_ENV') == 'local' ? 5000 : 0,
            'ref_by' => 1
        ]);

        $user = User::find(1);
        $user->ref_by = 2;
        $user->save();
    }
}

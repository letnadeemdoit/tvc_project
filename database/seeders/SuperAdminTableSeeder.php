<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'user_name' => 'super-admin',
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'password' => Hash::make('password'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'email' => 'superadmin@app.com',
                'remote_addr' => null,
                'confirm_hash' => null,
                'is_confirmed' => 1,
                'role' => 'SuperAdmin',
                'OwnerId' => null,
                'HouseId' => 0,
                'Intro' => null,
                'ShowOldSave' => null,
                'AdminOwner' => null,
                'Audit_user_name' => null,
                'Audit_Role' => null,
                'Audit_FirstName' => null,
                'Audit_LastName' => null,
                'Audit_Email' => null,
                'email_verified_at' => null,
                'old_password' => Hash::make('password'),
                'remember_token' => null,
                'current_team_id' => null,
                'profile_photo_path' => null,
                'updated_at' => now(),
            ],
        ]);
    }
}

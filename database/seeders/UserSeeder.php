<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $google2fa = app('pragmarx.google2fa');

        $superAdmin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'uuid' => (string) Str::uuid(),
                'name' => 'Super Admin Doe',
                'mobile' => '0',
                'role' => USER_ROLE_SUPER_ADMIN,
                'password' => Hash::make(123456),
                'status' => USER_STATUS_ACTIVE,
                'google2fa_secret' => $google2fa->generateSecretKey(),
                'email_verification_status' => 1,
                'phone_verification_status' => 1,
            ]
        );

        $admin = User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'uuid' => (string) Str::uuid(),
                'name' => 'User Doe',
                'mobile' => '043',
                'role' => USER_ROLE_ADMIN,
                'password' => Hash::make(123456),
                'status' => USER_STATUS_ACTIVE,
                'google2fa_secret' => $google2fa->generateSecretKey(),
                'email_verification_status' => 1,
                'phone_verification_status' => 1,
            ]
        );
    }
}

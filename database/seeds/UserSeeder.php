<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;

        $user->name = "Super Admin";
        $user->email = "superadmin@madinah.id";
        $user->email_verified_at = now();
        $user->password = "Aczx26120roe";

        $user->save();

        $user->assignRole('superadmin');
    }
}

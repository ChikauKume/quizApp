<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $admin = new User();
        $admin->name = "admin";
        $admin->email = "admin@gmail.com";
        $admin->password = bcrypt('password');
        $admin->visible_password = "password";
        $admin->email_verified_at = NOW();
        $admin->occupation = "CTO";
        $admin->address = "Japan";
        $admin->phone = "09022221234";
        $admin->is_admin = 1;
        $admin->save();
    }
}
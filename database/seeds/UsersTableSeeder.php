<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name'		=>'Md. Shagor Sarder',
            'email'		=>'shagor@gmail.com',
            'email_verified_at' => now(),
            'password'	=>bcrypt('shagor'),
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
        	'name'		=>'Md. Ripon mollah',
            'email'		=>'ripon@gmail.com',
            'email_verified_at' => now(),
            'password'	=>bcrypt('ripon'),
            'remember_token' => Str::random(10),
        ]);

    }
}

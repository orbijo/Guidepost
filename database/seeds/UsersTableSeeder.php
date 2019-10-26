<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
            [
                'name' => 'Josh Orbiso',
                'email' => 'arkorbz13@gmail.com',
                'password' => Hash::make('P@ssw0rd'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dio Brando',
                'email' => 'konodioda@gmail.com',
                'password' => Hash::make('P@ssw0rd'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Jotaro Kujo',
                'email' => 'starplatinum@gmail.com',
                'password' => Hash::make('P@ssw0rd'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Joseph Joestar',
                'email' => 'joestar@gmail.com',
                'password' => Hash::make('P@ssw0rd'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

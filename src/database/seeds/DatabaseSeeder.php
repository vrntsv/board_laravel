<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $userId = DB::table('users')->insertGetId(
            [
                'name' => 'admin',
                'email' => str_random(10).'@gmail.com',
                'email_verified_at' => now(),
                'password' => 'admin', // password
                'remember_token' => Str::random(10)
            ]
        );
        for ($i = 0; $i < 50; $i++){
            DB::table('ads')->insert([
                'user_id' => $userId,
                'title' => str_random(10),
                'phone' => '+1' . random_int(100000000, 999999999),
                'email' => str_random(10) . '@gmail.com',
                'description' => str_random(100),
                'country' => 'USA',
                'end_date' => Carbon::now()->addDays(10)
            ]);
        }
    }
}

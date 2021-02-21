<?php

use Faker\Factory as Fake;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $fake = Fake::create('ja_JP');
        DB::table('users')->insert([
            'name' => '顧客',
            'email' => 'user@a.com',
            'password' => Hash::make('pass'),
            'icon' => $fake->image('public/storage/', 1920, 1060, null, false),
            'created_at' => new Datetime(),
        ]);

        for ($i = 0; $i < 13; $i++) {
            DB::table('users')->insert([
                'name' => $fake->name,
                'email' => $fake->email,
                'password' => Hash::make('pass'),
                'icon' => $fake->image('public/storage/', 1920, 1060, null, false),
                'created_at' => new Datetime(),
            ]);
        }
    }
}

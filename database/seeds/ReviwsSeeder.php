<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Fake;

class ReviwsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = Fake::create('ja_JP');
        for ($i = 0; $i < 60; $i++) {
            DB::table('product_reviews')->insert([
                'user_id' => $fake->numberBetween(1, 10),
                'product_id' => $fake->numberBetween(1, 10) ,
                'title' => $fake->sentence,
                'body' => $fake->sentences(3, true),
                'rank'=> $fake->numberBetween(1, 5),
                'created_at' => new Datetime(),
            ]);
        }
    }
}

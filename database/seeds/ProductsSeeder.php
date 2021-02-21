<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Fake;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
  public function run()
   {
       $fake = Fake::create('ja_JP');
       for ($i = 0; $i < 30; $i++) {
           DB::table('products')->insert([
               'name' => $fake->sentence,
               'product_category_id' => $fake->numberBetween(1, 10) ,
               'price' => $fake->randomNumber(4),
               'description' => $fake->sentences(3, true),
               'icon'=> $fake->image('public/storage/', 1920, 1060, null, false),
               'created_at' => new Datetime(),
           ]);
       }
   }
}

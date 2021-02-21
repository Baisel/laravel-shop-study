<?php

use Illuminate\Database\Seeder;

class WishProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wish_products')->insert([
            [
                'user_id' => 1,
                'product_id' => 1,
            ],
            [
                'user_id' => 1,
                'product_id' => 2,
            ],
            [
                'user_id' => 1,
                'product_id' => 3,
            ],
            [
                'user_id' => 1,
                'product_id' => 4,
            ],
            [
                'user_id' => 1,
                'product_id' => 5,
            ],
            [
                'user_id' => 2,
                'product_id' => 1,
            ],
            [
                'user_id' => 2,
                'product_id' => 2,
            ],
            [
                'user_id' => 2,
                'product_id' => 3,
            ],
        ]);
    }
}

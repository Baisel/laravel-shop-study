<?php

use Illuminate\Database\Seeder;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
            [
                'name' => 'デジタルミュージック',
                'order_no' => 1
            ],
            [
                'name' => 'Androidアプリ',
                'order_no' => 2
            ],
            [
                'name' => '本',
                'order_no' => 3
            ],
            [
                'name' => '洋書',
                'order_no' => 4
            ],
            [
                'name' => 'ミュージック',
                'order_no' => 5
            ],
            [
                'name' => 'クラシック',
                'order_no' => 6
            ],
            [
                'name' => 'DVD',
                'order_no' => 7
            ],
            [
                'name' => 'TVゲーム',
                'order_no' => 8
            ],
            [
                'name' => 'PCソフト',
                'order_no' => 9
            ],
            [
                'name' => 'パソコン・周辺機器',
                'order_no' => 10
            ],
            [
                'name' => '家電&カメラ',
                'order_no' => 11
            ],
            [
                'name' => '文房具&オフィス用品',
                'order_no' => 12
            ],
            [
                'name' => 'ホーム&キッチン',
                'order_no' => 13
            ],
            [
                'name' => 'ペット用品',
                'order_no' => 14
            ],
            [
                'name' => 'ドラックストア',
                'order_no' => 15
            ],
            [
                'name' => 'ビューティー',
                'order_no' => 16
            ],
            [
                'name' => 'ラグジュアリービューティー',
                'order_no' => 17
            ],
            [
                'name' => '食品・飲料・お酒',
                'order_no' => 18
            ],
            [
                'name' => 'ベビー&マタニティ',
                'order_no' => 19
            ],
            [
                'name' => 'ファッション',
                'order_no' => 20
            ],
            [
                'name' => '服&ファッション小物',
                'order_no' => 21
            ],
            [
                'name' => 'シューズ&バッグ',
                'order_no' => 22
            ],
            [
                'name' => '腕時計',
                'order_no' => 23
            ],
            [
                'name' => 'ジュエリー',
                'order_no' => 24
            ],
            [
                'name' => 'おもちゃ',
                'order_no' => 25
            ],
            [
                'name' => 'ホビー',
                'order_no' => 26
            ],
            [
                'name' => '楽器',
                'order_no' => 27
            ],
            [
                'name' => 'スポーツ&アウトドア',
                'order_no' => 28
            ],
            [
                'name' => '車&バイク',
                'order_no' => 29
            ],
            [
                'name' => 'DIY・工具・ガーデン',
                'order_no' => 30
            ],
            [
                'name' => '大型家電',
                'order_no' => 31
            ],
            [
                'name' => 'クレジットカード',
                'order_no' => 32
            ],
            [
                'name' => 'ギフト券',
                'order_no' => 33
            ],
            [
                'name' => '産業・研究開発用品',
                'order_no' => 34
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\Producttype;

use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $novels = [
            [
                'ISBN' => '9786163371140',
                'product_name' => 'Re:Zero - Restarting Life from Zero in Another World Volume 1',
                'image' => 'https://cdn-local.mebmarket.com/meb/server1/157947/Thumbnail/book_detail_large.gif?2',
                'buy_price' => 171,
                'page_num' => 449,
                'publisher' => 'A Plus',
                'published_date' => '2015-10-1 00:00:00',
                'product_description' => 'description text',
                'author_name' => 'Nagatsuki Tappei',
                'quantity_stock' => 100
            ],
            [
                'ISBN' => '9786163371539',
                'product_name' => 'Re:Zero - Restarting Life from Zero in Another World Volume 2',
                'image' => 'https://cdn-local.mebmarket.com/meb/server1/157948/Thumbnail/book_detail_large.gif?2',
                'buy_price' => 198,
                'page_num' => 449,
                'publisher' => 'A Plus',
                'published_date' => '2015-10-1 00:00:00',
                'product_description' => 'description text',
                'author_name' => 'Nagatsuki Tappei',
                'quantity_stock' => 100
            ]
        ];

        $mangas = [
            [
                'ISBN' => '9786164474093',
                'product_name' => 'Fly Me to The Moon Volume 1',
                'image' => 'https://cdn1.mangaqube.com/O47BADSHBM9JDA58_l',
                'buy_price' => 80,
                'page_num' => 198,
                'publisher' => 'LuckPim',
                'published_date' => '2019-03-30 00:00:00',
                'product_description' => 'description text',
                'author_name' => 'Kenjiro Hata',
                'quantity_stock' => 100
            ],
            [
                'ISBN' => '9786164475892',
                'product_name' => 'Fly Me to The Moon Volume 2',
                'image' => 'https://cdn1.mangaqube.com/KFAOU330EJ61FP70_l',
                'buy_price' => 80,
                'page_num' => 200,
                'publisher' => 'LuckPim',
                'published_date' => '2019-08-16 00:00:00',
                'product_description' => 'description text',
                'author_name' => 'Kenjiro Hata',
                'quantity_stock' => 100
            ]
        ];

        if(!DB::table('producttypes')->where('type_des', 'novel')->exists())
                Producttype::create(['type_des' => 'novel']);
        if(!DB::table('producttypes')->where('type_des', 'manga')->exists())
                Producttype::create(['type_des' => 'manga']);

        foreach ($novels as $key => $value) {

            if(!DB::table('products')->where('product_name',$value['product_name'])->exists()){
                $value['type_ID'] = DB::table('producttypes')->where('type_des', 'novel')->pluck('type_ID')[0];
                Product::create($value);
            }

        }

        foreach ($mangas as $key => $value) {

            if(!DB::table('products')->where('product_name',$value['product_name'])->exists()){
                $value['type_ID'] = DB::table('producttypes')->where('type_des', 'manga')->pluck('type_ID')[0];
                Product::create($value);
            }

        }

    }
}

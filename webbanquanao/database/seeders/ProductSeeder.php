<?php

namespace Database\Seeders;

use App\Models\ImageProduct;
use App\Models\ProductModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[];
        $faker = Faker::create();
        // for ($i = 0; $i < 250000; $i++) {
        //     ProductModel::create(            [
        //         "name"=> $faker->name,
        //         "slug"=> Str::slug($faker->name),
        //         "code"=> now().$faker->name,
        //         "weight"=> 10,
        //         "height"=> 10,
        //         "content"=> $faker->text(100),
        //         "length"=> 10,
        //         "quantity"=> 100,
        //         "price"=> $faker->numberBetween(20000,200000),
        //         "status"=> 0,
        //         "category_id"=> $faker->numberBetween(1,9),
        //         "width"=> 10,
        //     ]);

        // }


        // for ($i = 0; $i < 250000; $i++) {
        //     ImageProduct::create();
        // }
        $name = fake()->name();
        $img = fake()->imageUrl();
        for ($i = 2000; $i < 230000; $i++) {
            $data[] = [
                'product_id' => $i,
                'name' =>$name,
                "code_image"=>$img
            ];
            // $data[] = [
            //     'product_id' => $i,
            //     'name' =>$name,
            //     "code_image"=>$img
            // ];
            if($i % 500 == 0) {
                DB::table('image_product')->insert($data);
                $data = [];
            }
        }

      // ProductModel::factory()->count(1000000)->create(); 
    }
}

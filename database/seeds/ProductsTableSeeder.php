<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $limit = 5;

        for ($i=1; $i <= $limit; $i++) { 
        	
        	DB::table('products')->insert([
                'name' => $faker->name,
                'image' => 'public/images/images.jpg',
                'price' => $faker->randomDigit,
                'description' => $faker->paragraph
            ]);
        }
    }
}

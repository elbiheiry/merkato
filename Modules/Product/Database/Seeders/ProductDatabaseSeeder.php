<?php

namespace Modules\Product\Database\Seeders;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

        for ($i=0; $i < 20; $i++) { 
            Product::create([
                'name' => 'Product #'.$i+1,
                'description' => 'Product description',
                'slug' => SlugService::createSlug(Product::class , 'slug' , 'category #'.$i+1 , ['unique' => true]),
                'price' => rand(0 , 999),
                'type_id' => rand(1 , 3),
                'category_id' => rand(1 , 3)
            ]);
        }
    }
}

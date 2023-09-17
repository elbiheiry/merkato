<?php

namespace Modules\Category\Database\Seeders;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;

class CategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

        // $this->call("OthersTableSeeder");

        for ($i=0; $i < 3; $i++) { 
            Category::create([
                'name' => 'category #'.$i+1,
                'slug' => SlugService::createSlug(Category::class , 'slug' , 'category #'.$i+1 , ['unique' => true])
            ]);
        }
    }
}

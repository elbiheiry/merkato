<?php

namespace Modules\Type\Database\Seeders;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Type\Entities\Type;

class TypeDatabaseSeeder extends Seeder
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
            Type::create([
                'name' => 'type #'.$i+1,
                'slug' => SlugService::createSlug(Type::class , 'slug' , 'type #'.$i+1 , ['unique' => true])
            ]);
        }
    }
}

<?php

namespace Modules\Home\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Home\Entities\Banner;
use Modules\Home\Entities\Offer;

class HomeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        for ($i=0; $i < 3; $i++) { 
            Offer::create([
                'name' => 'العرض رقم '.$i,
                'image' => fake()->imageUrl()
            ]);
        }

        Banner::create([
            'title' => 'أطلب كل اللي محتاجة لمطعمك أو الكافية بكل سهولة جرب الأن',
            'subtitle' => 'نوصلك في 24 ساعة',
            'image' => fake()->imageUrl()
        ]);

        // $this->call("OthersTableSeeder");
    }
}

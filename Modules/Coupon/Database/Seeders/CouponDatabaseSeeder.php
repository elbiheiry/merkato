<?php

namespace Modules\Coupon\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Modules\Coupon\Entities\Coupon;

class CouponDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

        for ($i=0; $i < 10; $i++) { 
            Coupon::create([
                'code' => 'code '.$i,
                'max_usage' => rand(1 , 100),
                'discount' => rand(1 , 25)
            ]);
        }

        // $this->call("OthersTableSeeder");
    }
}

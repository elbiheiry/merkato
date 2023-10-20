<?php

namespace Modules\Auth\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Entities\Admin;

class AuthDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@merkato-hub.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('gz3uvN3O7@7@'),
        ]);


        // $this->call("OthersTableSeeder");
    }
}

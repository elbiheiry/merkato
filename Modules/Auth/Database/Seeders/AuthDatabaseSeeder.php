<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;

class AuthDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin::create([
        //     'name' => 'admin',
        //     'email' => 'admin@merkato-hub.com',
        //     'email_verified_at' => Carbon::now(),
        //     'password' => bcrypt('gz3uvN3O7@7@'),
        // ]);

        $this->call(PermissionTableSeeder::class);
        $this->call(AdminSeeder::class);    


        // $this->call("OthersTableSeeder");
    }
}

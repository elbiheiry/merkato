<?php

namespace Modules\Page\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Page\Entities\Page;

class PageDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Page::create([
            'id' => 1,
            'slug' => 'privacy-police',
            'title' => 'سياسة الخصوصية',
            'description' => '<p> تجربه </p>'
        ]);

        Page::create([
            'id' => 2,
            'slug' => 'terms-and-conditions',
            'title' => 'الشروط والأحكام',
            'description' => '<p> تجربه </p>'
        ]);

        // $this->call("OthersTableSeeder");
    }
}

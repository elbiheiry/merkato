<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'عرض الأدمن',
            'إنشاء أدمن',
            'تعديل أدمن',
            'حذف أدمن',
            'عرض الصلاحيات',
            'إنشاء الصلاحية',
            'تعديل الصلاحية',
            'حذف الصلاحية'
        ];
        
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

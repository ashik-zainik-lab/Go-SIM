<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::where('id', '!=', 0)->delete();
        $now = now();
        $data = [
            ['name' => 'Manage Application Setting', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Manage Version Update', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
        ];
        Permission::insert($data);
    }
}

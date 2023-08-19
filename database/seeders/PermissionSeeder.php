<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionsConfig = config('permission-list', []);
        $permissions = $this->flattenPermissions($permissionsConfig);

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }
    }

    function flattenPermissions($permissions, $prefix = '') {
        $flattened = [];

        foreach ($permissions as $key => $value) {
            if (is_array($value)) {
                $flattened = array_merge($flattened, $this->flattenPermissions($value, $prefix . $key . '.'));
            } else {
                $flattened[] = $prefix . $value;
            }
        }

        return $flattened;
    }
}

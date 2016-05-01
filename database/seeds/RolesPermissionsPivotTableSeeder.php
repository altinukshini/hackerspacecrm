<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesPermissionsPivotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('permission_role')->truncate();

        $administrator = Role::whereName('administrator')->firstOrFail();
        $administrator->permissions()->sync(Permission::all());
    }
}

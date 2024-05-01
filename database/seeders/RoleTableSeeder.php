<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Traits\AccessTrait;
use Illuminate\Database\Seeder;


class RoleTableSeeder extends Seeder
{
    use AccessTrait;

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Super Admin',
            'description' => "super admin manages all the system roles and permissions",
            'permissions' => json_encode($this->getAllPermissions()),
            
            'entity_id' => 1,
            'user_id' => 1
        ]);
    }
}

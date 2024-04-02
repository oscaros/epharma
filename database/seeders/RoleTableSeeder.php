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
            'name' => 'Admin',
            'description' => "admin",
            'permissions' => json_encode($this->getAllPermissions()),
            
            'entity_id' => 1,
            'user_id' => 1
        ]);
    }
}

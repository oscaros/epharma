<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Department::create([
            'name' => 'Admin',
            'code' => 'ADMIN',
            'entity_id' => 1, // Assuming entity_id 1 exists or adjust accordingly
            // 'user_id' => 1 // Assuming user_id 1 exists or adjust accordingly
        ]);
    
    }
}

<?php

namespace Database\Seeders;

use App\Models\Entity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        

        Entity::create([
            
            'EntityName' => 'Pharmacy Main',
            'Email' => 'info@epharma.com',
            'Phone' => '0772722999',
            'Address' => 'Kampala, Uganda',
           
        ]);
    }
}

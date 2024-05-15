<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'System Super Admin',
            
                'email' => 'super@epharma.com',
                'password' => bcrypt('password'),
                'phone_number' => '0772722999',
                'email_verified_at' => now(),
                'role_id' => '1',
               
                'entity_id' => '1'

            ]
        ];
        foreach ($users as $key => $value) {
            $user = User::create($value);
        }
    }
}

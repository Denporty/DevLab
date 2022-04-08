<?php

namespace Database\Seeders;

use App\Models\Animation;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'contact@test.fr')->first();
        if ($user == null){
            User::create([
                'name' => 'Admin',
                'email' => 'contact@test.fr',
                'password' => Hash::make('Admin'),
                'admin' => true,
                'super_admin' => true,
                'department' => array_rand(Animation::DEPARTMENT, 1)
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name' => 'Ressources Humaines',
        ]);
        Department::create([
            'name' => 'Service Informatique',
        ]);
        Department::create([
            'name' => 'Externes',
        ]);
        Department::create([
            'name' => 'Resources et développement',
        ]);
        Department::create([
            'name' => 'Marketing',
        ]);
        Department::create([
            'name' => 'Community Management',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Séminaire',
        ]);
        Category::create([
            'name' => 'Pôt de départ',
        ]);
        Category::create([
            'name' => 'After Work',
        ]);
        Category::create([
            'name' => 'Activités diverses',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Animation;
use Illuminate\Database\Seeder;

class AnimationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Animation::factory(10)->create();
    }
}

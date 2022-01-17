<?php

namespace Database\Factories;

use App\Models\Animation;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnimationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Animation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->realTextBetween(50, 75),
            'description' => $this->faker->realTextBetween(500, 3500),
            'summary' => $this->faker->realTextBetween(150, 300),
            'localisation' => $this->faker->word(1, true),
            'tag'=> array_rand(Animation::CATEGORIES, 1),
            'department'=> array_rand(Animation::DEPARTMENT, 1),
            'places'=> $this->faker->numberBetween(5, 300),
            'active_section' => $this->faker->boolean(),
            'section_title' => $this->faker->realTextBetween(50, 75),
            'description_section' => $this->faker->realTextBetween(500, 3500),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'map' => '<iframe src="https://www.google.com/maps/d/embed?mid=1R7CpWZ-ML0bg9jI9jRoCd58b-QqsPD_n&ehbc=2E312F" width="640" height="480"></iframe>'
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\formation;
use Illuminate\Database\Eloquent\Factories\Factory;

class episodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
          'description'=> $this->faker->paragraphs(3,true),
          'video_url'=>'mavideo.com' . rand(10,255),
          'formation_id'=>formation::all()->random()->id

        ];
    }
}

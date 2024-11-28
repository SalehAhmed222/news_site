<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $paths=['imagesfaker/7.jpg','imagesfaker/1.jpg',
        'imagesfaker/12.jpg','imagesfaker/11.jpg','imagesfaker/9.jpg',
        'imagesfaker/8.jpg','imagesfaker/6.jpg','imagesfaker/13.jpg',
        'imagesfaker/10.jpg','imagesfaker/14.jpg','imagesfaker/17.jpg',
        'imagesfaker/5.jpg','imagesfaker/16.jpg',
        'imagesfaker/15.jpg','imagesfaker/3.jpg','imagesfaker/18.jpg',
        'imagesfaker/4.jpg','imagesfaker/2.jpg','imagesfaker/1.jpg',
        ];

        return [
            'path' =>fake()->randomElement($paths),
        ];
    }
}

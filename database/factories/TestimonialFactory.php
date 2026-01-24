<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Testimonial;

class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'role' => fake()->jobTitle(),
            'content' => fake()->paragraph(2),
            'rating' => fake()->numberBetween(4, 5), // Que des bonnes notes !
            'is_active' => true,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Testimonial $testimonial) {
            try {
                // Avatar (Portrait)
                $testimonial->addMediaFromUrl('https://i.pravatar.cc/300?u=' . rand(1, 1000))
                            ->toMediaCollection('avatar');
            } catch (\Exception $e) { }
        });
    }
}
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use App\Models\User;
use App\Models\EventType;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'title' => ['fr' => 'Événement : ' . fake()->company()],
            'slug' => fake()->slug(),
            'description' => ['fr' => fake()->paragraphs(3, true)],
            
            'user_id' => User::first()->id ?? User::factory(),
            'event_type_id' => EventType::inRandomOrder()->first()->id ?? EventType::factory(),
            
            'event_date' => fake()->dateTimeBetween('-6 months', '+6 months'),
            'location' => fake()->city() . ', Cameroun',
            'client_name' => fake()->name(),
            'testimonial' => ['fr' => fake()->paragraph()],
            
            'status' => 'published',
            'order' => fake()->numberBetween(1, 100),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Event $event) {
            try {
                // Image de couverture
                $event->addMediaFromUrl('https://picsum.photos/1200/800?random=' . rand(1000, 2000))
                      ->toMediaCollection('cover_image');
                
                // Galerie (3 images)
                for ($i = 0; $i < 3; $i++) {
                    $event->addMediaFromUrl('https://picsum.photos/800/600?random=' . rand(2001, 3000))
                          ->toMediaCollection('gallery');
                }
            } catch (\Exception $e) { }
        });
    }
}
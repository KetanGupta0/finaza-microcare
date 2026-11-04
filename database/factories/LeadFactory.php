<?php

namespace Database\Factories;

use App\Enums\LeadStatus;
use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => (string) fake()->numberBetween(6000000000, 9999999999),
            'email' => fake()->optional()->safeEmail(),
            'city' => fake()->randomElement(['Patna', 'Danapur', 'Phulwari Sharif', 'Hajipur', null]),
            'service' => fake()->randomElement(array_keys(config('site.services'))),
            'message' => fake()->optional()->sentence(12),
            'status' => LeadStatus::New,
            'source_page' => '/contact',
            'ip_address' => fake()->ipv4(),
        ];
    }

    /**
     * Mark the lead as already contacted.
     */
    public function contacted(): static
    {
        return $this->state(fn (array $attributes) => ['status' => LeadStatus::Contacted]);
    }
}

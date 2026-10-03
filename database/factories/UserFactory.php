<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'google_id' => (string) fake()->unique()->numberBetween(),
            'name' => $name = fake()->unique()->firstName(),
            'handle' => Str::slug($name),
            'remember_token' => Str::random(10),
        ];
    }

    public function withHandle(string $handle): Factory
    {
        return $this->state(
            fn(array $attributes) => ['handle' => Str::slug($handle)]
        );
    }
}

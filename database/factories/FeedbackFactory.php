<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'student_name' => fake()->name(),
            'student_email' => fake()->unique()->safeEmail(),
            'student_university_id' => fake()->numberBetween(1000000000, 1000900000),
            'title' => fake()->word,
            'message' => fake()->word,
            'type' => "Complaint",
            'status' => "Open",
            'urgent' => fake()->boolean(50)
            // 'remember_token' => Str::random(10),
            // 'email_verified_at' => now(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'name' => 'admin1',
            'email' => 'admin@app.com',
            'password' => Hash::make('123456'),
            'mobile' => '123123123123123',
            'email_verified_at' => now(),
            // 'remember_token' => Str::random(10),

        ];
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\Feedback::factory(21)->create();

        // \App\Models\Feedback::factory()->create([
        //     'student_name' => '',
        //
        // ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Job;
use App\Models\Application;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $user = User::factory()->create(); // Create a test user
        $job = Job::factory()->create(); // Create a test job

        // Create a test application for the user
        Application::create([
            'user_id' => $user->id,
            'job_id' => $job->id,
            'resume' => 'path/to/resume.pdf',
            'cover_letter' => 'This is a test cover letter.',
        ]);
    }
}

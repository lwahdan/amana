<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users to act as writers
        $users = User::all();

        // Check if there are users available
        if ($users->isEmpty()) {
            $this->command->info('No users found. Please create some users first.');
            return;
        }

        // Create dummy blogs
        foreach ($users as $user) {
            Blog::factory(5)->create([
                'writer_id' => $user->id,
                'writer_type' => get_class($user),
            ]);
        }

        $this->command->info('Blogs seeded successfully!');
    }
}

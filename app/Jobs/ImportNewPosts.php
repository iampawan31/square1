<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Hash;

class ImportNewPosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $response = Http::get('https://sq1-api-test.herokuapp.com/posts');
        if ($response->successful()) {
            $admin = User::firstOrNew(
                ['name' => 'admin'],
                ['email' => 'admin@gmail.com', 'password' => Hash::make('password')]
            );

            $admin->save();

            $newPosts = $response->json()['data'];
            foreach ($newPosts as $post) {
                Post::create([
                    'title' => $post['title'],
                    'description' => $post['description'],
                    'user_id' => $admin->id,
                    'publication_date' => $post['publication_date'],
                    'status' => 1
                ]);
            }
        } else {
            echo "Entered Else";
            // Add Logic for sending notification to Admin regarding import failure
        }
    }
}

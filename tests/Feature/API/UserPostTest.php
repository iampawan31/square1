<?php

namespace Tests\Feature\API;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserPostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_get_related_posts()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);

        Sanctum::actingAs($user);

        $this->getJson(route('api.v1.users.posts'))
            ->assertStatus(200)
            ->assertJsonCount(1);
    }
}

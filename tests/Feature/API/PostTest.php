<?php

namespace Tests\Feature\API;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_paginated_posts()
    {
        $posts = Post::factory(10)->create();

        $this->getJson(route('api.v1.posts'))
            ->assertStatus(200)
            ->assertSee('data');
    }


    /** @test */
    public function authenticated_user_can_get_related_posts()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);

        Sanctum::actingAs($user);

        $this->getJson(route('api.v1.posts.get-posts'))
            ->assertStatus(200)
            ->assertJsonCount(1);
    }

    /** @test */
    public function authenticated_user_can_create_new_post()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $this->postJson(route('api.v1.posts.save-post'), [
            'title' => 'sample title',
            'description' => 'sample description',
            'publication_date' => '2021-02-08'
        ])
            ->assertStatus(201);

        $this->assertDatabaseHas('posts', [
            'title' => 'sample title',
            'user_id' => $user->id
        ]);
    }
}

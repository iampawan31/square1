<?php

namespace Tests\Unit;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected $post;

    protected function setUp(): void
    {
        parent::setUp();
        $this->post = Post::factory()->create();
    }

    /** @test */
    public function post_must_have_a_title()
    {
        $this->assertNotEmpty($this->post->title);
    }

    /** @test */
    public function post_must_have_description()
    {
        $this->assertNotEmpty($this->post->description);
    }

    /** @test */
    public function post_must_be_associated_with_an_user()
    {
        $this->assertNotEmpty($this->post->user_id);
    }

    /** @test */
    public function user_information_can_be_fetched_from_a_post()
    {
        $this->assertNotNull(1, $this->post->user);
    }

    /** @test */
    public function can_get_post_with_only_active_status()
    {
        $draftPost = Post::factory()->create([
            'status' => 0
        ]);

        $this->assertCount(1, Post::active()->get());
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadThreadsTest extends TestCase
{
    use DatabaseTransactions;

    protected $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }
    /**
     * @test
     * a user can browse threads
     */
    public function a_user_can_browse_threads()
    {
        $response = $this->get('/threads')
                    ->assertStatus(200)
                    ->assertSee($this->thread->title);
    }

    /**
     * @test
     * a user can read a single thread
     */
    public function a_user_can_read_a_single_thread()
    {
        $response = $this->get($this->thread->path());

        $response->assertStatus(200);
        $response->assertSee($this->thread->title);
    }

    /**
     * @test
     * a user can read replies that are associated with a thread
     */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

        $response = $this->get($this->thread->path())
                        ->assertSee($reply->body)
                        ->assertSee($reply->owner->name)
                        ->assertSee($reply->created_at->diffForHumans());
    }
}

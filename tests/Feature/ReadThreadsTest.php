<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadThreadsTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * @test
     * a user can browse threads
     */
    public function a_user_can_browse_threads()
    {
        $thread = factory('App\Thread')->create();
        $response = $this->get('/thread');

        $response->assertStatus(200);
        $response->assertSee($thread->title);
    }

    /**
     * @test
     * a user can read a single thread
     */
    public function a_user_can_read_a_single_thread()
    {
        $thread = factory('App\Thread')->create();
        $response = $this->get('/thread/'.$thread->id);

        $response->assertStatus(200);
        $response->assertSee($thread->title);
    }
}

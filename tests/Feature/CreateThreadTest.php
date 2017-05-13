<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateThreadTest extends TestCase
{
	use DatabaseTransactions;

	/**
	 * @test
	 * a guest may not create new thread
	 */
	public function a_guest_may_not_create_new_thread()
	{
		$this->expectException('Illuminate\Auth\AuthenticationException');
		$this->post('/threads', []);		
	}

    /**
     * @test
     * an authenticated user can create new forum thread
     */
    public function an_authenticated_user_can_create_new_forum_thread()
    {
    	// $user = create('App\User');
    	// $this->be($user);
        $this->signIn();

    	$thread = make('App\Thread');
    	$this->post('/threads', $thread->toArray());

    	$this->get($thread->path())
    		 ->assertSee($thread->title)
    		 ->assertSee($thread->body);
    }
}

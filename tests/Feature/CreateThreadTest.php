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
        $this->withExceptionHandling()->get('/threads/create')->assertRedirect('/login');

		$this->post('/threads', [])->assertRedirect('/login');		
	}

    /**
     * @test
     * an authenticated user can create new forum thread
     */
    public function an_authenticated_user_can_create_new_forum_thread()
    {
        $this->signIn();

    	$thread = make('App\Thread');

    	$response = $this->post('/threads', $thread->toArray());

    	$this->get($response->headers->get('Location'))
    		 ->assertSee($thread->title)
    		 ->assertSee($thread->body);
    }

    /**
     * @test
     * a thread requires a title
     */
    public function a_thread_requires_a_title()
    {
        $this->publishThread(['title'=>null])
             ->assertSessionHasErrors('title');
    }

    /**
     * @test
     * a thread requires a body
     */
    public function a_thread_requires_a_body()
    {
        $this->publishThread(['body'=>null])
             ->assertSessionHasErrors('body');
    }

    protected function publishThread($attributes = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread', $attributes);

        return $this->post('/threads', $thread->toArray());
    }
}

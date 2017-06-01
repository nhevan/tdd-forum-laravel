<?php

namespace Tests\Feature;

use App\Channel;
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

        $name = auth()->user()->name;
        $this->get('/profile/'.$name)
             ->assertSee($thread->title);
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
        $this->publishThread(['body' => null])
             ->assertSessionHasErrors('body');
    }

    /**
     * @test
     * a thread requires a valid channel
     */
    public function a_thread_requires_a_valid_channel()
    {
        factory('App\Channel', 2)->create(); //creates 2 channels with id 1 and 2 as we are using DatabaseTransactions

        $this->publishThread(['channel_id' => null])
             ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 999])
             ->assertSessionHasErrors('channel_id');
    }

    /**
     * @test
     * unauthorized users can not delete threads
     */
    public function unauthorized_users_can_not_delete_threads()
    {
        $this->withExceptionHandling();
        $thread = create('App\Thread');

        $this->delete($thread->path())
             ->assertRedirect('/login');

        $this->signIn();
        $this->delete($thread->path())
             ->assertStatus(403);
    }

    /**
     * @test
     * a thread can be deleted
     */
    public function a_thread_can_be_deleted_by_thread_owner()
    {
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $reply = create('App\Reply', ['thread_id'=>$thread->id]);

        $response = $this->json('DELETE', $thread->path());

        $response->assertStatus(204);
        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        
        $this->assertDatabaseMissing('activities', [
            'subject_id' => $thread->id,
            'subject_type' => get_class($thread)
        ]);
        $this->assertDatabaseMissing('activities', [
            'subject_id' => $reply->id,
            'subject_type' => get_class($reply)
        ]);
    }

    protected function publishThread($attributes = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread', $attributes);

        return $this->post('/threads', $thread->toArray());
    }
}

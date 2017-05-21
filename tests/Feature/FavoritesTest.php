<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FavoritesTest extends TestCase
{
    use DatabaseTransactions;
	/**
	 * @test
	 * an unauthenticated user can not favorite a reply
	 */
	public function an_unauthenticated_user_can_not_favorite_a_reply()
	{
		$this->withExceptionHandling();
    	$this->post("replies/1/favorites")
    		 ->assertRedirect('login');
	}

    /**
     * @test
     * an authenticated user can favorite any reply
     */
    public function an_authenticated_user_can_favorite_any_reply()
    {
    	$this->signIn();

    	$thread = create('App\Thread');
    	$reply = create('App\Reply', ['thread_id' => $thread->id]);

    	$this->post("replies/{$reply->id}/favorites");
		$this->assertCount(1, $reply->favorites);
    }

    /**
     * @test
     * a user can not favorite a reply more than once
     */
    public function a_user_can_not_favorite_a_reply_more_than_once()
    {
    	$this->signIn();

    	$thread = create('App\Thread');
    	$reply = create('App\Reply', ['thread_id' => $thread->id]);

    	$this->post("replies/{$reply->id}/favorites");
    	$this->post("replies/{$reply->id}/favorites");
    	
		$this->assertCount(1, $reply->favorites);
    }
}

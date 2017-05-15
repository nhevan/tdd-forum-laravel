<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParticipateInForumTest extends TestCase
{
	use DatabaseTransactions;

	/**
	 * @test
	 * unauthenticated users may not add replies
	 */
	public function unauthenticated_users_may_not_add_replies()
	{
    	$this->expectException('Illuminate\Auth\AuthenticationException');
    	$this->post('/threads/channel-slug/1/replies', []);
	}

    /**
     * @test
     * an authenticated user can post a reply
     */
    public function an_authenticated_user_can_post_a_reply()
    {
    	$thread = create('App\Thread');

    	$this->signIn();

    	$reply = make('App\Reply');
    	$this->post($thread->path().'/replies', $reply->toArray());

    	$this->get($thread->path())
    		 ->assertSee($reply->body);
    }
}

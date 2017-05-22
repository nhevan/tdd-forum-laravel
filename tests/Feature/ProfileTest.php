<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfileTest extends TestCase
{
	use DatabaseTransactions;

    /**
     * @test
     * a user has a profile
     */
    public function a_user_has_a_profile()
    {
    	$user = create('App\User');

    	$this->get("/profile/{$user->name}")
    		 ->assertSee($user->name);
    }

    /**
     * @test
     * a profile contains all the threads associated with the user
     */
    public function a_profile_contains_all_the_threads_associated_with_the_user()
    {
    	$user = create('App\User');
    	$post = create('App\Thread', ['user_id' => $user->id]);

    	$this->get("/profile/{$user->name}")
    		 ->assertSee($post->title)
    		 ->assertSee($post->body);
    }
}

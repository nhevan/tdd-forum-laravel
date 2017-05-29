<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ActivityTest extends TestCase
{
	use DatabaseTransactions;

    /**
     * @test
     * it records activity when a thread is created
     */
    public function it_records_activity_when_a_thread_is_created()
    {
    	$this->signIn();
    	$thread = create('App\Thread', ['user_id' => auth()->id()]);

    	$this->assertDatabaseHas('activities', [
    		'user_id' => auth()->id(),
    		'type' => 'created_thread',
    		'subject_id' => $thread->id,
    		'subject_type' => 'App\Thread'
		]);
    }
}

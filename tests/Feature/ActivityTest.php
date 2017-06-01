<?php

namespace Tests\Feature;

use App\Activity;
use Carbon\Carbon;
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

    	$activity = Activity::first();
		$this->assertEquals($activity->subject->id, $thread->id);
    }

    /**
     * @test
     * it records activity when a reply is created
     */
    public function it_records_activity_when_a_reply_is_created()
    {
    	$this->signIn();
    	$thread = create('App\Thread', ['user_id' => auth()->id()]);
    	$reply = create('App\Reply', ['thread_id' => $thread->id, 'user_id' => auth()->id()]);

    	$this->assertDatabaseHas('activities', [
    		'user_id' => auth()->id(),
    		'type' => 'created_reply',
    		'subject_id' => $reply->id,
    		'subject_type' => 'App\Reply'
		]);

		$this->assertCount(2, Activity::all());
    }

    /**
     * @test
     * it fetches a activity feed for a given user
     */
    public function it_fetches_a_activity_feed_for_a_given_user()
    {
        $this->signIn();
        create('App\Thread', ['user_id'=>auth()->id()], 2);
        auth()->user()->activity()->first()->update(['created_at' => Carbon::now()->subWeek()]);

        $feed = Activity::feed(auth()->user());

        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->format('Y-m-d')
        ));

        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->subWeek()->format('Y-m-d')
        ));
    }
}

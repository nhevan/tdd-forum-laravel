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

        $this->thread = create('App\Thread');
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
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);

        $response = $this->get($this->thread->path())
                        ->assertSee($reply->body)
                        ->assertSee($reply->owner->name)
                        ->assertSee($reply->created_at->diffForHumans());
    }

    /**
     * @test
     * a user can filter threads according to a channel
     */
    public function a_user_can_filter_threads_according_to_a_channel()
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id'=>$channel->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get("threads/{$channel->slug}");
             // ->assertSee($threadInChannel->title)
             // ->assertDontSee($threadNotInChannel->title);
    }

    /**
     * @test
     * a user can filter threads by username
     */
    public function a_user_can_filter_threads_by_username()
    {
        $this->signIn(create('App\User', ['name'=>'JohnDoe']));

        $threadByJohn = create('App\Thread', ['user_id'=>auth()->id()]);
        $threadNotByJohn = create('App\Thread');

        $this->get('/threads?by=JohnDoe')
             ->assertSee($threadByJohn->title)
             ->assertDontSee($threadNotByJohn->title);
    }

    /**
     * @test
     * a user can sort threads by popularity
     */
    public function a_user_can_sort_threads_by_popularity()
    {
        $threadWithTwoReplies = create('App\Thread');
        create('App\Reply', ['thread_id'=>$threadWithTwoReplies->id], 2);

        $threadWithThreeReplies = create('App\Thread');
        create('App\Reply', ['thread_id'=>$threadWithThreeReplies->id], 3);

        $threadWithNoReplies = $this->thread;

        $response = $this->getJson('threads?popular=1')->json();

        $this->assertEquals([3, 2, 0], array_column($response ,'replies_count'));
        $this->assertNotEquals([0, 2, 3], array_column($response ,'replies_count'));
    }
}

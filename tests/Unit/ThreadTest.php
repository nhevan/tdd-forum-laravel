<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadTest extends TestCase
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
	 * a thread has a creator
	 */
	public function a_thread_has_a_creator()
	{
		$this->assertInstanceOf(User::class, $this->thread->creator);
	}

	/**
	 * @test
	 * a thread has many replies
	 */
	public function a_thread_has_many_replies()
	{
		$replies = factory('App\Reply', 5)->create(['thread_id' => $this->thread->id]);

		$this->assertInstanceOf(HasMany::class, $this->thread->replies());
		$this->assertEquals(5, $this->thread->replies()->count());
	}

	/**
	 * @test
	 * a thread can add a reply
	 */
	public function a_thread_can_add_a_reply()
	{
		$this->thread->addReply([
			'body' => 'FooBar',
			'user_id' => create('App\User')->id
		]);

		$this->assertEquals(1, $this->thread->replies()->count());
	}

	/**
	 * @test
	 * a thread belongs to channel
	 */
	public function a_thread_belongs_to_channel()
	{
		$thread = create('App\Thread');

		$this->assertInstanceOf('App\Channel', $thread->channel);
	}

	/**
	 * @test
	 * a thread returns channel name in its path
	 */
	public function a_thread_returns_channel_name_in_its_path()
	{
		$thread = create('App\Thread');

		$this->assertEquals("/threads/{$thread->channel->slug}/{$thread->id}", $thread->path());
	}
}

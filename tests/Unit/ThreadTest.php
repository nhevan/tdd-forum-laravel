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

		$this->thread = factory('App\Thread')->create();
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
	 * a thread has a creator
	 */
	public function a_thread_has_a_creator()
	{
		$this->assertInstanceOf(User::class, $this->thread->creator);
	}

	/**
	 * @test
	 * a thread can add a reply
	 */
	public function a_thread_can_add_a_reply()
	{
		$this->thread->addReply([
			'body' => 'FooBar',
			'user_id' => 1
		]);

		$this->assertEquals(1, $this->thread->replies()->count());
	}
}

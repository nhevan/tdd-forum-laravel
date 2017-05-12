<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadTest extends TestCase
{
	use DatabaseTransactions;
	/**
	 * @test
	 * a thread has many replies
	 */
	public function a_thread_has_many_replies()
	{
		$thread = factory('App\Thread')->create();
		$replies = factory('App\Reply', 5)->create(['thread_id' => $thread->id]);

		$this->assertInstanceOf(HasMany::class, $thread->replies());
		$this->assertEquals(5, $thread->replies()->count());
	}
}

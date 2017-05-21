<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReplyTest extends TestCase
{
	use DatabaseTransactions;
    /**
     * @test
     * it has a owner
     */
    public function it_has_a_owner()
    {
        $thread = create('App\Thread');
    	$reply = create('App\Reply');

    	$this->assertInstanceOf(User::class, $reply->owner);
    }
}

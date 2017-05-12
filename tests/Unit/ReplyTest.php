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
    	$reply = factory('App\Reply')->create();

    	$this->assertInstanceOf(User::class, $reply->owner);
    }
}

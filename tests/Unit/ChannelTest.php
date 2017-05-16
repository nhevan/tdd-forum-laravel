<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChannelTest extends TestCase
{
    /**
     * @test
     * it has many threads
     */
    public function it_has_many_threads()
    {
    	$channel = create('App\Channel');
    	$threads = factory('App\Thread', 10)->create([ 'channel_id' => $channel->id ]);

    	$this->assertInstanceOf(HasMany::class, $channel->threads());
    	$this->assertInstanceOf('App\Thread', $channel->threads->first());
    	$this->assertTrue($channel->threads->contains($threads[0]));
    	$this->assertCount(10, $channel->threads);
    	$this->assertNotCount(5, $channel->threads);

    	// $thread = factory('App\Thread')->create([ 'channel_id' => $channel->id ]);
    	// $this->assertTrue($channel->threads->contains($thread));
    }
}

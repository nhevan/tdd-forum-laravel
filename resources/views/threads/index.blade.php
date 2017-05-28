@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @forelse ($threads as $thread)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="level">
                            <h4 class="flex">
                                <a href="{{ route('threads.show', [$thread->channel->slug, $thread->id]) }}">{{ $thread->title }}</a>
                            </h4>
                            <a href="{{ route('threads.show', [$thread->channel->slug, $thread->id]) }}">
                                <strong>{{$thread->replies_count}} {{ str_plural('reply', $thread->replies_count) }}</strong>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <p>{{ $thread->body }}</p> 
                    </div>
                </div>
            @empty
                <p class="text-center">There are no threads in this channel.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

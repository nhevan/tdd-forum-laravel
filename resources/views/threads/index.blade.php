@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Threads</div>

                <div class="panel-body">
                    @foreach ($threads as $thread)
                        <div class="level">
                            <h4 class="flex">
                                <a href="{{ route('threads.show', [$thread->channel->slug, $thread->id]) }}">{{ $thread->title }}</a>
                            </h4>
                            <a href="{{ route('threads.show', [$thread->channel->slug, $thread->id]) }}">
                                <strong>{{$thread->replies_count}} {{ str_plural('reply', $thread->replies_count) }}</strong>
                            </a>
                        </div>
                        <p>{{ $thread->body }}</p> 
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

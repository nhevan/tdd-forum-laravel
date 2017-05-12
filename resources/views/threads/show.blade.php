@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>{{ $thread->title }}</strong></div>

                <div class="panel-body">
                   {{ $thread->body }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Replies</div>
    
                <div class="panel-body">
                    @foreach ($thread->replies as $reply)
                       <p>{{ $reply->body }}</p>
                       <p style="font-size: smaller; margin: 0;" class="text-right"><a href="">{{$reply->owner->name}}</a> replied {{$reply->created_at->diffForHumans()}}</p>
                       <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

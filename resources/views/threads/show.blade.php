@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="#">{{$thread->creator->name }}</a> posted :
                    <strong>{{ $thread->title }}</strong>
                </div>

                <div class="panel-body">
                   {{ $thread->body }}
                </div>
            </div>
            @include ('replies.add')
            @include ('threads.replies')
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>This was posted {{$thread->created_at->diffForHumans()}} by <a href="#">{{$thread->creator->name}}</a>. This thread has {{$thread->replies_count}} {{ str_plural('comment', $thread->replies_count) }}.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

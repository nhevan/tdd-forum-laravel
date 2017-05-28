@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="level">
                        <strong class="flex">{{ $thread->title }}</strong>
                        @can('update', $thread)
                            <form action="{{ $thread->path() }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button type="submit" class="btn btn-link">Delete Thread</button>
                            </form>
                        @endcan
                    </div>
                    
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
                    <p>This was posted {{$thread->created_at->diffForHumans()}} by <a href="{{ route('profile', $thread->creator) }}">{{$thread->creator->name}}</a>. This thread has {{$thread->replies_count}} {{ str_plural('comment', $thread->replies_count) }}.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

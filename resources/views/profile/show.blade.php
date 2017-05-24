@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
	        <div class="col-md-8 col-md-offset-2">
	        	<div class="page-header level" style="margin-top: 0px;">
					<h1>{{ $profileUser->name }}</h1>
					<small style="position: relative; top: 14px; left: 20px;">since {{ $profileUser->created_at->diffForHumans() }}</small>
	        	</div>
	        	@foreach ($threads as $thread)
	        		<div class="panel panel-default">
		                <div class="panel-heading level">
		                    <a href="{{ route('threads.show', [$thread->channel->slug, $thread->id]) }}">
		                    	<strong class="flex">{{ $thread->title }}</strong>
	                    	</a>
		                    <small>posted {{ $thread->created_at->diffForHumans() }}</small>
		                </div>

		                <div class="panel-body">
		                   {{ $thread->body }}
		                </div>
		            </div>
	        	@endforeach
	        	<div class="text-center">{{ $threads->links() }}</div>
	        </div>
        </div>
	</div>
@endsection
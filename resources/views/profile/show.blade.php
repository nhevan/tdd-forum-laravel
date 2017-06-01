@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
	        <div class="col-md-8 col-md-offset-2">
	        	<div class="page-header level" style="margin-top: 0px;">
					<h1>{{ $profileUser->name }}</h1>
					<small style="position: relative; top: 14px; left: 20px;">since {{ $profileUser->created_at->diffForHumans() }}</small>
	        	</div>
	        	@foreach ($activities as $date => $activity)
	        		<h3 class="page-header">{{$date}}</h3>
	        		@foreach ($activity as $record)
	        			@if (view()->exists("profile.activities.{$record->type}"))
			        		@include('profile.activities.'.$record->type, ['activity' => $record])
	        			@endif
	        		@endforeach
	        	@endforeach
	        </div>
        </div>
	</div>
@endsection
@component('profile.activities.activity')
	@slot('header')
	    {{$profileUser->name}} published <a style="padding-left: 5px;" href="{{$activity->subject->path()}}">"{{ $activity->subject->title }}"</a>
	@endslot
	@slot('body')
	    {{ $activity->subject->body }}
	@endslot
@endcomponent
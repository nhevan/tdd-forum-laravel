@component('profile.activities.activity')
	@slot('header')
	    {{$profileUser->name}} replied to <a style="padding-left: 5px;" href="{{$activity->subject->thread->path()}}">"{{ $activity->subject->thread->title }}"</a>
	@endslot
	@slot('body')
	    {{ $activity->subject->body }}
	@endslot
@endcomponent
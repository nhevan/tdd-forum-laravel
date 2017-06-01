@component('profile.activities.activity')
	@slot('header')
	    {{$profileUser->name}} favorited a <a href="{{ $activity->subject->favorited->path() }}">reply</a>.
	@endslot
	@slot('body')
	    {{ $activity->subject->favorited->body }}
	@endslot
@endcomponent
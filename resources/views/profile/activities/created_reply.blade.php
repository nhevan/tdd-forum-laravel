<div class="panel panel-default">
	<div class="panel-heading level">
		{{$profileUser->name}} replied to <a style="padding-left: 5px;" href="{{$activity->subject->thread->path()}}">"{{ $activity->subject->thread->title }}"</a>
	</div>
	<div class="panel-body">
		{{ $activity->subject->body }}
	</div>
</div>
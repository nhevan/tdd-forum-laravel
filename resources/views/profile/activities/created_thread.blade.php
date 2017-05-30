<div class="panel panel-default">
	<div class="panel-heading level">
		{{$profileUser->name}} published <a style="padding-left: 5px;" href="{{$activity->subject->path()}}">"{{ $activity->subject->title }}"</a>
	</div>
	<div class="panel-body">
		{{ $activity->subject->body }}
	</div>
</div>
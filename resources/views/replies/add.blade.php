@if (auth()->check())
	<div class="panel panel-default">
	    <div class="panel-body">
			<form action="{{ route('replies.add', [$thread->channel->slug, $thread->id]) }}" method="POST" role="form">
				{{ csrf_field() }}
				<div class="form-group">
					<div class="col-sm-12">
						<textarea name="body" id="textareaBody" class="form-control" rows="2" required="required" placeholder="Got something to say ?"></textarea>
					</div>
				</div>
				<br>
				<hr>
				<button type="submit" class="btn btn-primary pull-right" style="margin-right: 15px;">Submit</button>
			</form>
	    </div>
	</div>
@else
	<p class="text-center">Please <a href="{{ route('login') }}">signin</a> to contribute on this thread</p>
@endif
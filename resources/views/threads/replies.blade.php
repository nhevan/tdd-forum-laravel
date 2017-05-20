<div class="panel panel-default">
    <div class="panel-heading">Replies</div>

    <div class="panel-body">
        @foreach ($replies as $reply)
			<p>{{ $reply->body }}</p>
			<div class="level">
				<h6 class="flex">
					<a href="">{{$reply->owner->name}}</a> replied {{$reply->created_at->diffForHumans()}}					
				</h6>
				<form action="{{ url("replies/{$reply->id}/favorites") }}" method="POST" role="form">
					{{ csrf_field() }}				
					<button type="submit" class="btn btn-xs {{ $reply->isFavorite() ? 'disabled':'' }}">
						{{ $reply->favorites()->count() }}
						{{ str_plural('Favorite', $reply->favorites()->count()) }}
					</button>
				</form>
			</div>
			<hr>
        @endforeach
		{{ $replies->links() }}

    </div>
</div>
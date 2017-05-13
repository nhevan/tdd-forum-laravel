<div class="panel panel-default">
    <div class="panel-heading">Replies</div>

    <div class="panel-body">
        @foreach ($thread->replies as $reply)
           <p>{{ $reply->body }}</p>
           <p style="font-size: smaller; margin: 0;" class="text-right"><a href="">{{$reply->owner->name}}</a> replied {{$reply->created_at->diffForHumans()}}</p>
           <hr>
        @endforeach
    </div>
</div>
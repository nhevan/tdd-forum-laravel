@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a Thread</div>

                <div class="panel-body">
                    <form action="{{ route('threads.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="channel" class="col-sm-2 control-label">Channel:</label>
                            <select name="channel_id" id="channel" class="form-control" required="required">
                                <option value="">Choose a channel</option>
                                @foreach (App\Channel::all() as $channel)
                                    <option value="{{$channel->id}}">{{$channel->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Title:</label>
                            <input type="text" name="title" id="title" placeholder="Enter a thread title ..." class="form-control" required="required" value="{{old('title')}}" />
                        </div>
                        <div class="form-group">
                            <label for="textareaBody" class="col-sm-2 control-label">Body:</label>
                            <textarea name="body" id="textareaBody" placeholder="Enter thread body ..." class="form-control" rows="5" required="required">{{old('body')}}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Publish</button>
                        </div>
                        @if (count($errors) > 0)
                            <div class="form-group">
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

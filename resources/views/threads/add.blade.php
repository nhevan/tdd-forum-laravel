@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a Thread</div>

                <div class="panel-body">
                    <form action="{{ route('threads.store') }}" method="POST" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Title:</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" id="title" class="form-control" required="required" />
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="textareaBody" class="col-sm-2 control-label">Body:</label>
                            <div class="col-sm-10">
                                <textarea name="body" id="textareaBody" class="form-control" rows="5" required="required"></textarea>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

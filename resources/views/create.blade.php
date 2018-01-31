@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create new card</div>

                <div class="panel-body">
                    <form method="POST" action="{{route('card.store')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Card title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

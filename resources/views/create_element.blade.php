@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('partials.card')
            @include('partials.elements')
            <div class="panel panel-default">
                <div class="panel-heading">Create new element</div>

                <div class="panel-body">
                    <form method="POST" action="{{route('card.store.element',$card->id)}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Element title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="points">Points</label>
                            <input type="text" class="form-control" id="points" name="points">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

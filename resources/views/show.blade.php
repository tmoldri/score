@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            @include('partials.card')
        </div>
        <div class="col-md-6">
            <h4>Choose only activities that you have done in your life</h4>
            <hr>
            <form method="POST" action="{{route('card.score',[$card->id])}}" class="text-left">
                {{ csrf_field() }}
                @foreach ($elements as $element)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$element->id}}" name="elements[]" @if (!$element->users->isEmpty()) checked @endif>
                        <label class="form-check-label" for="element_{{$element->id}}">
                            <div class="number">[+ {{ number_format($element->points,0,'.',',') }} points]</div> {{ $element->title }}
                        </label>
                    </div>
                @endforeach
                <br><br>
                @guest
                    You have to log in to score!
                @endguest
                @auth
                    <button class="btn btn-sm btn-info" name="action" value="blue" type="submit">Update</button>
                @endauth
            </form>
        </div>
    </div>
@endsection

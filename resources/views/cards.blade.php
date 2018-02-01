@extends('layouts.app')

@section('content')
    <h1>What is your score of life?</h1>
    <p>Select card and check boxes on things you have done in your life.</p><br><br>
    <div class="row">
        @foreach ($cards as $card)
            <div class="col-md-4">
                @include('partials.card')
            </div>
        @endforeach
    </div>
@endsection

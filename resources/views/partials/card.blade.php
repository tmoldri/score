<div class="panel panel-default">
    <div class="panel-body text-center">
        <h3><a href="{{route('card.show',$card->id)}}">{{$card->title}}</a></h3>
        <hr>
        <h2 class="number">+{{ number_format($card->total_points,0,'.',',') }}</h2>
        <hr>
        <h4>Your score: <strong class="number">{{number_format($card->user_points,0,'.',',')}}</strong></h4>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
    	<ul>
		    @foreach ($card->elements as $element)
		        <li><b>[+{{$element->points}} points</b>] - {{$element->title}}</li>
		    @endforeach
		</ul>
	</div>
</div>
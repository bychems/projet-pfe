@extends("default")
@section('title',$title)

@section('content')


    <h1>Voiture Disponible pour le Test Drive</h1>
    <ul>
        @foreach($cars as $car)
            @if(!empty($car->model))
                <li><a href="{{route('Calendar', $car->id)}}">{{ $car->model }}</a></li>
            @endif
        @endforeach

    </ul>
@stop
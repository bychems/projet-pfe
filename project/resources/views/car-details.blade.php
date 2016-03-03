@extends("default")
@section('title',$title)


@section('content')


    <h1>Voiture</h1>

    @foreach($categories as $category)

        <h3>{{$category['name']}}</h3>
        <ul>
            @foreach($category['options'] as $option)


                <li> <strong>Nom Option:</strong>{{$option->name_option}} - <strong>Desc Option:</strong> {{$option->description_option}} </li>
            @endforeach
        </ul>
    @endforeach
@stop
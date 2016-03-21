@extends("default")
@section('title',$title)


@section('content')


    <h1>Client: {{$customer->name}} {{$customer->last_name}}</h1><hr>
        <ul>

            <li> <strong>Cin Client:</strong>{{$customer->cin}}</li>
            <li> <strong>Adresse Client:</strong>{{$customer->adress}}</li>
            <li> <strong>Email Client:</strong>{{$customer->mail}}</li>
            <li> <strong>Fonction Client:</strong>{{$customer->function}}</li>

        </ul>

    <div>
    <a href="{{route('editcustomer',$customer->id)}}"><button class="btn btn-success droite" type="submit">Modifier</button></a>
    </div>


@stop
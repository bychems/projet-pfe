@extends("default")
@section('title',$title)


@section('content')


    <h1>Client: {{$customer->name}} {{$customer->last_name}}</h1><hr>
        <ul>
            <table>
            <tr><td><li><strong>Cin Client:</strong></li></td>   <td>{{$customer->cin}}</td></tr>
                <tr><td><li><strong>Adresse Client:</strong></li></td>   <td>{{$customer->adress}}</td></tr>
                <tr><td><li><strong>Email Client:</strong></li></td>   <td>{{$customer->mail}}</td></tr>
                <tr><td><li><strong>Fonction Client:</strong></li></td>   <td>{{$customer->function}}</td></tr>
                <tr><td><li><strong>T&eacute;l&eacute;phone Client:</strong></li></td>   <td>{{$customer->phone}}</td></tr>
                <tr><td><li><strong>Voiture Client:</strong></li></td>   <td>{{$customer->car}}</td></tr>
            </table>
        </ul>

    <div>
    <a href="{{route('editcustomer',$customer->id)}}"><button class="btn btn-success droite" type="submit">Modifier</button></a>
    </div>


@stop
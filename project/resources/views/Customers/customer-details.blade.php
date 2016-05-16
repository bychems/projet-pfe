@extends("default")
@section('title',$title)

@section('banner')

    <div class="banner">
        <div class="container">
            <div class="col-md-3" style="text-align: center">
                <h2>D&eacute;tail Client</h2>
            </div>
        </div>
    </div>

@stop

@section('content')


    <h1>Client: {{$customer->name}} {{$customer->last_name}} <a href="{{route('editcustomer',$customer->id)}}"><button class="btn btn-success droite" type="submit">Modifier</button></a></h1><hr>
        <ul>
            <table border="1"  cellpadding="10" style="text-align: center">
            <tr><td style="width:60%; height: 45px;"><strong>Cin Client:</strong></td>   <td style="width:60%">{{$customer->cin}}</td></tr>
                <tr><td style="width:60%; height: 45px;"><strong>Adresse Client:</strong></td>   <td>{{$customer->adress}}</td></tr>
                <tr><td style="width:60%; height: 45px;"><strong>Email Client:</strong></td>   <td>{{$customer->mail}}</td></tr>
                <tr><td style="width:60%; height: 45px;"><strong>Fonction Client:</strong></td>   <td>{{$customer->function}}</td></tr>
                <tr><td style="width:60%; height: 45px;"><strong>T&eacute;l&eacute;phone Client:</strong></td>   <td>{{$customer->phone}}</td></tr>
                <tr><td style="width:60%; height: 45px;"><strong>Voiture Client:</strong></td>   <td>{{$customer->car}}</td></tr>
            </table>
        </ul>

    <div>

    </div>


@stop



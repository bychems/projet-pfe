@extends("default")
@section('title',$title)


@section('content')


    <h1>Utilisateur: {{$user->name}}</h1><hr>
    <ul>
        <table>
            <tr><td><li><strong>Role:</strong></li></td>   <td>{{$role_name}}</td></tr>
            <tr><td><li><strong>Email:</strong></li></td>   <td>{{$user->email}}</td></tr>
            <tr><td><li><strong>Phone:</strong></li></td>   <td>{{$user->phone}}</td></tr>

        </table>
    </ul>



@stop
@extends("default")
@section('title',$title)

@section('banner')

    <div class="banner">
        <div class="container">
            <div class="col-md-3" style="text-align: center">
                <h2>Liste Utilisateurs</h2>
            </div>
        </div>
    </div>

@stop

@section('content')


<table id="list_users_table" class="table">
    <thead>
    <tr>
        <th class="milieu">Nom et pr&eacute;nom</th>
        <th class="milieu">Email</th>
        <th class="milieu">T&eacute;l&eacute;phone</th>
        <th class="milieu">Role</th>


    </tr>

    </thead>
    <tbody>
    @foreach($users as $user)

            <tr>
                <td class="milieu">{{ $user->name }}</td>
                <td class="milieu">{{ $user->email }}</td>
                <td class="milieu">{{ $user->phone }}</td>
                <td class="milieu">{{ $user->roles()->get()[0]->display_name }}</td>

            </tr>

    @endforeach
    </tbody>

</table>


@stop

@section('js')
    <script>
        $(document).ready(function(){
            $('#list_users_table').DataTable();
        });

    </script>
@stop
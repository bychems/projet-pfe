@extends("default")
@section('title',$title)

@section('banner')

    <div class="banner">
        <div class="container">
            <div class="col-md-3" style="text-align: center">
                <h2>Liste Des Clients</h2>
            </div>
        </div>
    </div>

@stop

@section('content')



<table id="list_customers_table" class="table">
    <thead>
    <tr>
        <th class="milieu">Nom</th>
        <th class="milieu">Pr&eacute;nom</th>
        <th class="milieu">Cin</th>
        <th class="milieu">Email</th>
        <th class="milieu">Action</th>
    </tr>

    </thead>
    <tbody>
    @foreach($customers as $customer)
        @if(!empty($customer->name))

            <tr>
                <td class="milieu">{{ $customer->name }}</td>
                <td class="milieu">{{ $customer->last_name }}</td>
                <td class="milieu">{{ $customer->cin }}</td>
                <td class="milieu">{{ $customer->mail }}</td>
                <td class="milieu"><a href="{{route('afficheCustomer', $customer->id)}}"><button type="button" class="btn btn-info">Info</button></a></td>
            </tr>

        @endif
    @endforeach
    </tbody>

</table>
@stop

@section('js')
    <script>
        $(document).ready(function(){
            $('#list_customers_table').DataTable();
        });
    </script>
@stop
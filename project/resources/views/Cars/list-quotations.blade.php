@extends("default")
@section('title',$title)

@section('banner')

    <div class="banner">
        <div class="container">
            <div class="col-md-3" style="text-align: center">
                <h2>Liste des devis</h2>
            </div>
        </div>
    </div>

@stop

@section('content')


    <table id="list_quotations_table" class="table">
        <thead>
        <tr>
            <th class="milieu">Nom du client</th>
            <th class="milieu">Pr&eacute;nom du client</th>
            <th class="milieu">Finition voiture</th>
            <th class="milieu">Prix voiture demand&eacute;</th>


        </tr>

        </thead>
        <tbody>
        @foreach($quotations as $quotation)

            <tr>
                <td class="milieu">{{ $customers[$quotation->id_customer -1]->name }}</td>
                <td class="milieu">{{ $customers[$quotation->id_customer -1]->last_name }}</td>
                <td class="milieu">{{ $cars[$quotation->id_car -1]->finition }}</td>
                <td class="milieu">{{ $quotation->total_price }}</td>

            </tr>

        @endforeach
        </tbody>

    </table>


@stop

@section('js')
    <script>
        $(document).ready(function(){
            $('#list_quotations_table').DataTable();
        });

    </script>
@stop
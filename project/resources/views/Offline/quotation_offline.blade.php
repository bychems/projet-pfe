@extends("default")
@section('title',$title)

@section('banner')
    <div class="banner">
        <div class="container">
            <div class="col-md-3" style="text-align: center">
                <h2>Demandes Devis <br> OFFLINE </h2>
            </div>
        </div>
    </div>

@endsection
@section('content')

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Nouveaux Devis</div>
        <!-- Table -->
        <table class="table">
            <thead>
            <tr>
                <th class="milieu">Client</th>
                <th class="milieu">Voiture</th>
                <th class="milieu">Prix Total</th>
                <th class="milieu">Action</th>
            </tr>
            </thead>
            <tbody class="table_new_quotation">

            </tbody>
        </table>
        <button class="droite save_all_quotations hidden btn btn-success ">Sauvegarder tout</button>
    </div>


@endsection

@section('js')
    <script>
        var addQuotationRoute= "{{route('addQuotationOffline')}}";
        var token ="{{ csrf_token() }}";

        $(document).ready(function(){
            getNewQuotations();
        });
    </script>
@endsection


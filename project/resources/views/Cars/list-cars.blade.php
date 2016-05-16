@extends("default")
@section('title',$title)

@section('banner')

    <div class="banner">
        <div class="container">
            <div class="col-md-3" style="text-align: center">
                <h2>Liste Voitures</h2>
            </div>
        </div>
    </div>

@stop

@section('content')


<table id="list_cars_table" class="table">
    <thead>
    <tr>
        <th class="milieu">Mod&egrave;le</th>
        <th class="milieu">Finition</th>
        <th class="milieu">Prix basique</th>
        <th class="milieu">Disponibilit&eacute; Test Drive</th>

        <th class="milieu">Action</th>
    </tr>

    </thead>
    <tbody>
    @foreach($cars as $car)
        @if(!empty($car->finition))

            <tr>
                <td class="milieu">{{ $car->modele()->get()[0]->name }}</td>
                <td class="milieu">{{ $car->finition }}</td>
                <td class="milieu">{{ $car->basic_price }}</td>
                <td class="milieu">
                    @if($car->test_drive ==1)
                        Disponible
                    @else
                        Non disponible
                    @endif

                </td>

                <td class="milieu">
                    <a href="{{route('carAffiche', $car->id)}}" title="Devis"><button class="fa fa-info"></button></a>
                    <a href="{{route('carEdit', $car->id)}}" title="Modifier"><button class="fa fa-pencil-square-o" aria-hidden="true"></button></a>
                    <button class="fa fa-times-circle supp_car {{$car->id}}" style="visibility: visible" title="Supprimer" type='submit' data-id="{{$car->id}}" data-toggle="modal" data-target="#confirmDelete" data-title="Supprimer Voiture" data-message='Etes vous sure de vouloir supprimer cette voiture?'></button>
                </td>
            </tr>

        @endif
    @endforeach
    </tbody>

</table>

@include('delete_confirm')
@stop

@section('js')
    <script>
        $(document).ready(function(){
            $('#list_cars_table').DataTable();
        });

        var carDelete="{{route('carDelete',0)}}";
        carDelete = carDelete.slice(0, - 1);


        $('#confirmDelete').on('show.bs.modal', function (e) {
            $message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text($message);
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text($title);
            $id = $(e.relatedTarget).attr('data-id');

            // Pass form reference to modal for submission on yes/ok
            //var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-footer #confirm').data('id', $id);
        });

        <!-- Form confirm (yes/ok) handler, submits form -->
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function(e){
            e.preventDefault();

            $id=$(this).data('id');

            var Route=carDelete+$id;
            var res= $('.'+$id).parent();

            $.ajax({
                url: Route,
                type: 'GET',
                data: '',
                dataType: 'text',
                success: function(response) {
                    res.parent().remove();

                },
                fail: function(response) {
                }
            });
        });
    </script>
@stop
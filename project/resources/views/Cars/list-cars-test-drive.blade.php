@extends("default")
@section('title',$title)

@section('banner')

    <div class="banner">
        <div class="container">
            <div class="col-md-3" style="text-align: center">
                <h2>Liste Voitures<br>TEST DRIVE</h2>
            </div>

        </div>
    </div>

@stop

@section('content')




    <table id="list_cars_test_drive_table" class="table">
        <thead>
        <tr>
            <th class="milieu">Mod&egrave;le</th>
            <th class="milieu">Prix basique</th>
            <th class="milieu">Disponibilit&eacute; Test Drive</th>

            <th class="milieu">Action</th>
        </tr>

        </thead>
        <tbody>
        @foreach($cars as $car)
            @if(!empty($car->model))

                <tr>
                    <td class="milieu">{{ $car->model }}</td>
                    <td class="milieu">{{ $car->basic_price }}</td>
                    <td class="milieu">
                        @if($car->test_drive ==1)
                            Disponible
                        @else
                            Non disponible
                        @endif

                    </td>

                    <td class="milieu"><a href="{{route('Calendar', $car->id)}}"><button type="button" class="btn btn-info">Calendrier</button></a></td>
                </tr>

            @endif
        @endforeach
        </tbody>

    </table>
@stop

@section('js')
    <script>
        $(document).ready(function(){
            $('#list_cars_test_drive_table').DataTable();
        });
    </script>
@stop
@extends("default")
@section('title',$title)

@section('content')

    <h1 align="center">Calendrier</h1>

    <ul>

        @foreach($dateDispo as $date)
            @if(!empty($date->date))
                <li class="haut">
                    {{$date->date}}
                    <button class="btn btn-info modifier" name={{$date->id}}>Modifier</button>
                    <a href="calendar-Test-Drive.blade.php"></a>
                    <button class="btn btn-info supp">Supprimer</button>
                </li>
            @endif
        @endforeach

    </ul>

@stop

@section('js')
    <script src="{{ url('../resources/assets/plugins/datePicker/js/bootstrap-datepicker.js') }}"></script>
    <script>
        hoursRoute= "{{route('Hours',0)}}";
        hoursRoute = hoursRoute.slice(0, -1);
        console.log(hoursRoute);
    </script>
@stop
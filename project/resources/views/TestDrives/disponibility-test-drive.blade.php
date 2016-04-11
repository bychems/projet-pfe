@extends("default")
@section('title',$title)

@section('banner')

    <div class="banner">
        <div class="container">
            <div class="col-md-3" style="text-align: center"><h2>Disponibilit&eacute; <br> TEST DRIVE</h2></div>
        </div>
    </div>

@stop

@section('content')
    <h1>Voitures</h1>
    {!! Form::open(['method'=>'post', 'url'=>route('adddisp') , 'files'=>true])!!}
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                {!! Form::label('',' Model de la voiture:') !!}
                {!! Form::select('cars', $cars,null,['class'=>'form-control ']) !!}
            </div>
        </div>
    </div><hr>
    <h1>Disponibilité</h1>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                {!! Form::label('','Date Début:') !!}
                {!! Form::text('date_debut','',['class'=>'datepicker-drive form-control','placeholder'=>$date]) !!}
            </div>
            <div class="col-md-4">
                {!! Form::label('','Date Fin:') !!}
                {!! Form::text('date_fin','',['class'=>'datepicker-drive form-control','placeholder'=>$date]) !!}
            </div>
        </div>
    </div>
    <button class="btn btn-success" type="submit">save</button>
    {!!Form::close()!!}
@stop
@section('js')
    <script src="{{ url('project/resources/assets/plugins/datePicker/js/bootstrap-datepicker.js') }}"></script>
@stop
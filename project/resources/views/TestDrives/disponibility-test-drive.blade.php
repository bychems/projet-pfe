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
    <div style="margin-left: 80px">
    <h1>Voitures</h1>
    {!! Form::open(['method'=>'post', 'url'=>route('adddisp') , 'files'=>true])!!}

    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                {!! Form::label('',' Mod&egrave;le de la voiture:') !!}
                {!! Form::select('models', $models,null,['class'=>'form-control select_model']) !!}
            </div>
            <div class="col-md-4 finition_div hidden  ">
                {!! Form::label('fn',' Finition de la voiture:') !!}
                {!! Form::select('cars', $models,null,['class'=>'form-control ']) !!}
            </div>
            
        </div>
    </div><hr>
    <h1>Disponibilit&eacute;</h1>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                {!! Form::label('','Date D&eacute;but:') !!}
                {!! Form::text('date_debut','',['class'=>'datepicker-drive form-control inp_debut','disabled'=>'true','placeholder'=>$date]) !!}
            </div>
            <div class="col-md-4">
                {!! Form::label('','Date Fin:') !!}
                {!! Form::text('date_fin','',['class'=>'datepicker-drive form-control inp_fin','disabled'=>'true','placeholder'=>$date]) !!}
            </div>
            <div class="col-md-4">
                <button class="btn btn-success" type="submit" style="margin-top: 24px;">Modifier</button>
            </div>
        </div>
    </div>


    {!!Form::close()!!}
    </div>
@stop
@section('js')
<script>
    var routeFinition="{{route('getfinition',0)}}";
        routeFinition = routeFinition.slice(0, - 1);
</script>
    <script src="{{ url('project/resources/assets/plugins/datePicker/js/bootstrap-datepicker.js') }}"></script>
@stop
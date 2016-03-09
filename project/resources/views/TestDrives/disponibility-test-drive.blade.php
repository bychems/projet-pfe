@extends("default")
@section('title',$title)

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
            {!! Form::text('date_debut',$date,['class'=>'datepicker form-control ']) !!}
        </div>    
        <div class="col-md-4">
            {!! Form::label('','Date Fin:') !!}
            {!! Form::text('date_fin','',['class'=>'datepicker form-control ']) !!}
        </div>    
</div>
</div>
    <button class="btn btn-success" type="submit">save</button>
{!!Form::close()!!}

@stop

@section('js')

@stop
@extends("default")
@section('title',$title)

@section('content')
    <h1>Modifier Voiture</h1>
    {!! Form::open(['method'=>'put','files'=>true, 'url'=>route('addCars.update',$car) ])!!}
        <div class="form-group">
        {!! Form::label('model','Modele') !!}
        {!! Form::text('model', $car->modele,['class'=>'form-control', 'placeholder'=>'Modele de la voiture']) !!}
        </div>
        <div class="form-group">
        {!! Form::label('picture','Photo') !!}
        {!! Form::file('picture',$car->picture) !!}
        </div>
    <div class="form-group">
        {!! Form::label('vide','Video') !!}
        {!! Form::text('video', $car->video,['class'=>'form-control', 'placeholder'=>'Lien de la video']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('basic_price','Prix basique') !!}
        {!! Form::text('basic_price', $car->basic_price,['class'=>'form-control', 'placeholder'=>'Modele de la voiture']) !!}
    </div>

    <button class="btn btn-success" type="submit">save</button>
    {!! Form::close()!!}

@stop





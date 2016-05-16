@extends("default")
@section('title',$title)

@section('banner')

    <div class="banner">
        <div class="container">
            <div class="col-md-3" style="text-align: center">
                <h2>Modifier Client</h2>
            </div>
        </div>
    </div>

@stop

@section('content')



    <div class="contenu">
    {!! Form::model($customer, ['method'=>'put', 'url'=>route('updatecustomer',$customer->id ) ])!!}

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                </ul>
            </div>

    @endif



    <div class="form-group">
        {!! Form::label('','Nom') !!}
        {!! Form::text('name', null,['class'=>'form-control', 'placeholder'=>'Nom du client']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('','Pr&eacute;nom') !!}
        {!! Form::text('last_name',  null,['class'=>'form-control', 'placeholder'=>'Pr&eacute;nom du client']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('','Cin') !!}
        {!! Form::text('cin',  null,['class'=>'form-control', 'placeholder'=>'Num CIN']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('','Email') !!}
        {!! Form::text('mail',  null,['class'=>'form-control', 'placeholder'=>'Email du client']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('','Adresse') !!}
        {!! Form::text('adress',  null,['class'=>'form-control', 'placeholder'=>'Adresse du client']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('','Fonction') !!}<br>
        {!! Form::text('function',  null,['class'=>'form-control', 'placeholder'=>'Fonction du client']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('','T&eacute;l&eacute;phone') !!}<br>
        {!! Form::text('phone',  null,['class'=>'form-control', 'placeholder'=>'T&eacute;l&eacute;phone du client']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('','Voiture') !!}<br>
        {!! Form::text('car',  null,['class'=>'form-control', 'placeholder'=>'Voiture du client']) !!}
    </div>
    <button class="btn btn-success" type="submit">Modifier</button>
    </div>
    {!! Form::close() !!}
@stop
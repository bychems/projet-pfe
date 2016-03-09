@extends("default")
@section('title',$title)

@section('content')


    <h1>Ajouter Client</h1>
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
        {!! Form::label('','Prenom') !!}
        {!! Form::text('last_name',  null,['class'=>'form-control', 'placeholder'=>'Prenom du client']) !!}
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
    <button class="btn btn-success" type="submit">save</button>
    </div>
    {!! Form::close() !!}
@stop
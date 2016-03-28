@extends("default")
@section('title',$title)

@section('content')


    <h1>Ajouter Client</h1>
    <div class="contenu">
    {!! Form::open(['method'=>'post','file'=>true, 'url'=>route('addcustomer') ])!!}

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                </ul>
            </div>

    @endif


    <div class="row">
        <div class="form-group col-md-6">
            {!! Form::label('','Nom') !!}
            {!! Form::text('name', '',['class'=>'form-control', 'placeholder'=>'Nom du client']) !!}
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            {!! Form::label('','Pr&eacute;nom') !!}
            {!! Form::text('last_name', '',['class'=>'form-control', 'placeholder'=>'Pr&eacute;nom du client']) !!}
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            {!! Form::label('','Cin') !!}
            {!! Form::text('cin', '',['class'=>'form-control', 'placeholder'=>'Num CIN']) !!}
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            {!! Form::label('','Email') !!}
            {!! Form::email('mail', '',['class'=>'form-control', 'placeholder'=>'Email du client']) !!}
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            {!! Form::label('','Adresse') !!}
            {!! Form::text('adress', '',['class'=>'form-control', 'placeholder'=>'Adresse du client']) !!}
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            {!! Form::label('','Fonction') !!}<br>
            {!! Form::text('function', '',['class'=>'form-control', 'placeholder'=>'Fonction du client']) !!}
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            {!! Form::label('','T&eacute;l&eacute;phone') !!}<br>
            {!! Form::number('phone', '',['class'=>'form-control', 'placeholder'=>'T&eacute;l&eacute;phone du client']) !!}
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            {!! Form::label('','Voiture') !!}<br>
            {!! Form::text('car', '',['class'=>'form-control', 'placeholder'=>'Voiture du client']) !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
           <button class="btn btn-success" type="submit">Enregistrer</button>
        </div>
    </div>
</div>
    {!! Form::close() !!}
@stop
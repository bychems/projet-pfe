@extends("default")
@section('title',$title)

@section('banner')

    <div class="banner">
        <div class="container">
            <div class="col-md-3" style="text-align: center"><h2>Nouvelle Voiture</h2></div>
        </div>
    </div>

@stop

@section('content')

{!! Form::open(['method'=>'post','files'=>true, 'url'=>route('carStore') , 'files'=>true])!!}

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>

@endif

<div style="margin-left: 80px">
<div class="row">
    <div class="form-group col-md-4 select_model">
        {!! Form::label('',' Mod&egrave;le de la voiture:') !!}

        {!! Form::select('model', $tab_model,null,['class'=>'form-control ']) !!}
    </div>
    <div class="col-md-4" style=" margin-top: 31px;  margin-left: 107px;">
        <label>{!! Form::checkbox('chk_new_model', 0, null,['class'=>'chk_new_model']) !!}Nouveau mod&egrave;le</label>

    </div>

</div>

    <div class="row hidden" id="new_model_div">
        <div class="form-group col-md-8">
            {!! Form::label('',' Mod&egrave;le de la voiture:') !!}

            {!! Form::text('new_model_name', '',['class'=>'form-control new_model', 'placeholder'=>'Mod&egrave;le de la voiture']) !!}
        </div>
    </div>

<div class="row">
    <div class="form-group col-md-8">
        {!! Form::label('description','Description') !!}
        {!! Form::textarea('description', '',['class'=>'form-control', 'placeholder'=>'Description de la voiture', 'required'=>true]) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-8">
        {!! Form::label('finition','Finition') !!}
        {!! Form::text('finition', '',['class'=>'form-control', 'placeholder'=>'Finition de la voiture', 'required'=>true]) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-8">
        {!! Form::label('IconeC','Icone') !!}
        {!! Form::file('icon_finition') !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-8">
        {!! Form::label('Consommation','Consommation') !!}
        {!! Form::text('consommation', '',['class'=>'form-control', 'placeholder'=>'Consommation de la voiture', 'required'=>true]) !!}
    </div>
</div>

<div class="row">
<div class="form-group col-md-8">
    {!! Form::label('pictureL','Photos') !!}
    {!! Form::file('picture[]', ['multiple'=>true]) !!}
</div>
</div>

<div class="row">
<div class="form-group col-md-8">
    {!! Form::label('videoL','Vid&eacute;o') !!}
    {!! Form::url('video', '',['class'=>'form-control', 'placeholder'=>'Lien de la vid&eacute;o']) !!}
</div>
</div>

<div class="row">
<div class="form-group col-md-8">
    {!! Form::label('basic_priceL','Prix basique (DT)') !!}
    {!! Form::number('basic_price', '',['class'=>'form-control', 'placeholder'=>'Prix basique de la voiture']) !!}
</div>
</div>

<div class="row">
<div class="form-group col-md-8">
    {!! Form::label('disponible','Disponible dans le garage') !!}<br>
    {!! Form::radio('test_drive', '1',false) !!}
    {!! Form::label('oui','OUI',['style'=>'margin-right: 24px;']) !!}
    {!! Form::radio('test_drive', '0',false) !!}
    {!! Form::label('non','NON') !!}
</div>
</div>
<hr>

{!! Form::hidden('tab_option', "") !!}

<h2>Categories d'options disponibles</h2>
@if(isset($categories))
   @foreach($categories as $c)
    @if (isset($c))
        @if (isset($opp[$c->id]))
            <div class="row">
                <div class="form-group col-md-8">
                    <h3>Cat&eacute;gorie : {{$c->name_category}}</h3>
                </div>
            </div>

                    <div id="parent-{{$c->id}}" class="rows">
                        <div class="row to-copy line-input">
                            <div class="col-md-6">
                                {!! Form::label('','Choisissez une option &aacute; ajouter pour la voiture :') !!}
                                {!! Form::select('option', $opp[$c->id],null,['class'=>'form-control option','name'=>'option-'.$c->id]) !!}
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-info add-option" data-id="{{$c->id}}"><i class="fa fa-plus" ></i>Ajouter</button>
                            </div>
                            <br>

                        </div>
                        <div class="row">
                        <div class="col-md-6" id="new_option_{{$c->id}}" style="padding-left: 13px;">

                        </div>
                        </div>
                    </div>

            @endif
        @endif
   @endforeach
@endif
    <button class="btn btn-success" type="submit" style="margin-left: 404px;">Enregistrer</button>
</div>

{!! Form::close()!!}
<div class="hidden" id="to-clone">
    <div class="col-md-8">
        <p></p>
    </div>
    <div class="col-md-4">
        {!! Form::number('', '',['class'=>'form-control price', 'placeholder'=>'Prix (DT)','required'=>true]) !!}
    </div>
</div> 
@stop
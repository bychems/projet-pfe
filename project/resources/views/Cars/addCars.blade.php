@extends("default")
@section('title',$title)

@section('content')
<h1>Ajouter Voiture</h1>
{!! Form::open(['method'=>'post', 'url'=>route('carStore') , 'files'=>true])!!}
<div class="row">
<div class="form-group col-md-8">
    {!! Form::label('modelL','Modele') !!}
    {!! Form::text('model', '',['class'=>'form-control', 'placeholder'=>'Modele de la voiture', 'required'=>true]) !!}
</div>
</div>

<div class="row">
<div class="form-group col-md-8">
    {!! Form::label('pictureL','Photo') !!}
    {!! Form::file('picture[]', ['multiple'=>true]) !!}
</div>
</div>

<div class="row">
<div class="form-group col-md-8">
    {!! Form::label('videoL','Video') !!}
    {!! Form::text('video', '',['class'=>'form-control', 'placeholder'=>'Lien de la video']) !!}
</div>
</div>

<div class="row">
<div class="form-group col-md-8">
    {!! Form::label('basic_priceL','Prix basique') !!}
    {!! Form::text('basic_price', '',['class'=>'form-control', 'placeholder'=>'Modele de la voiture']) !!}
</div>
</div>

<div class="row">
<div class="form-group col-md-8">
    {!! Form::label('disponible','Disponible dans le garage') !!}<br>
    {!! Form::radio('test_drive', '1',false) !!}
    {!! Form::label('oui','OUI') !!}
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
                    <h3>Categorie : {{$c->name_category}}</h3>
                </div>
            </div>

                    <div id="parent-{{$c->id}}" class="rows">
                        <div class="row to-copy line-input">
                            <div class="col-md-3">
                                {!! Form::label('','Option :') !!}
                                {!! Form::select('option', $opp[$c->id],null,['class'=>'form-control option','name'=>'option-'.$c->id]) !!}
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-info add-option" data-id="{{$c->id}}"><i class="fa fa-plus" ></i>Ajouter</button>
                            </div>
                            <br>
                            <div class="col-md-6" id="new_option_{{$c->id}}">

                            </div>
                        </div>
                    </div>

            @endif
        @endif
   @endforeach
@endif
<button class="btn btn-success" type="submit">save</button>
{!! Form::close()!!}
<div class="hidden" id="to-clone">
    <div class="col-md-8">
        <p></p>
    </div>
    <div class="col-md-4">
        {!! Form::text('', '',['class'=>'form-control price', 'placeholder'=>'Prix','required'=>true]) !!}
    </div>
</div> 
@stop
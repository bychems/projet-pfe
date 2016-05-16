@extends("default")
@section('title',$title)

@section('banner')

<div class="banner">
    <div class="container">
        <div class="col-md-3" style="text-align: center"><h2>Modifier voiture</h2></div>
    </div>
</div>

@stop

@section('content')

<!-- Wrapper for slides -->
<h1>Modifier Voiture {{$car->modele()->get()[0]->name}} {{$car->finition}}</h1>
{!! Form::open(['method'=>'put', 'url'=>route('carUpdate',$car->id) , 'files'=>true])!!}
<div class="form-group">
    {!! Form::label('descriptiontxt','Description') !!}
    {!! Form::textarea('description', $car->description,['class'=>'form-control', 'placeholder'=>'Description de la voiture', 'required'=>true]) !!}
</div>
<div class="form-group">
    {!! Form::label('finition','Finition') !!}
    {!! Form::text('finition', $car->finition,['class'=>'form-control', 'placeholder'=>'Finition de la voiture', 'required'=>true]) !!}
</div>

<div class="form-group">
    {!! Form::label('IconeC','Icone') !!}
    {!! Form::file('icon_finition') !!}
</div>

<div class="form-group">
    {!! Form::label('pictureL','Photo') !!}
    {!! Form::file('picture[]', ['multiple'=>true]) !!}
</div>
<div class="form-group">
    {!! Form::label('videoL','Video') !!}
    {!! Form::text('video', $car->video,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('basic_priceL','Prix basique') !!}
    {!! Form::text('basic_price', $car->basic_price,['class'=>'form-control', 'placeholder'=>'Modele de la voiture']) !!}
</div>
<div class="form-group">
    {!! Form::label('disponible','Disponible dans le garage') !!}<br>
    {!! Form::radio('test_drive', 0,false) !!}
    {!! Form::label('oui','OUI') !!}
    {!! Form::radio('test_drive', '0',false) !!}
    {!! Form::label('non','NON') !!}
</div>

<p class="hidden" > {{$old_options=""}}</p>
@if(isset($listAllcategories))
@foreach($listAllcategories as $key_cat=>$category)
{{$tab_new_option=null}}
<h3>Categorie : {{$category['name']}}</h3>

@foreach($category['options'] as $key_op=>$option)
@if(isset($categories[$key_cat]['options'][$key_op]))
<div class="row ">
    <div class="col-md-2">
        {!! Form::label('','Option :') !!}
    </div>
    <div class="col-md-2">
        <p><b>Nom: </b>{{$categories[$key_cat]['options'][$key_op]['name']}}</p>
    </div>
    <div class="col-md-5">
        <p><b>Description: </b>{{$categories[$key_cat]['options'][$key_op]['description']}}</p>
    </div>
    <div class="col-md-3">
        <b>Prix: </b>{!! Form::text('price-'.$key_op, $categories[$key_cat]['options'][$key_op]['price'],['class'=>'form-control']) !!}
        <p class="hidden" > {{$old_options=$key_op.'-'.$old_options}}</p>
    </div>
</div>
@else
<p class="hidden" > {{$tab_new_option[$key_op]=$option['name']}}</p>
@endif
@endforeach
@if($tab_new_option!=null)
<div class="row " id="parent-{{$key_cat}}">
    <div class="row to-copy line-input">
        <div class="col-md-3">
            {!! Form::label('','New Option :') !!}
            {!! Form::select('option', $tab_new_option,null,['class'=>'form-control option','name'=>'option-'.$key_cat]) !!}
        </div>
        <div class="col-md-3">
            <button class="btn btn-info add-option" data-id="{{$key_cat}}"><i class="fa fa-plus" ></i>Ajouter</button>
        </div>
        <br>
        <div class="col-md-6" id="new_option_{{$key_cat}}">

        </div>
    </div>
</div>
@endif
@endforeach
{!! Form::hidden('tab_old_option', $old_options) !!}
{!! Form::hidden('tab_option', "") !!}
@endif
<button class="btn btn-success droite" type="submit">Enregistrer</button>

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
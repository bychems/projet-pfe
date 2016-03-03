@extends("default")
@section('title',$title)

<style>
    h3{
        background: #F5F5F5;
        border-radius: 7px;
        padding: 10px 20px;
        font-size: 17px !important;
        text-transform: uppercase;
        border: 1px solid rgba(221, 221, 221, 0.86);
        margin-top: 35px !important;
    }
    .dddd {
        background: red;
    }
    .rows .row {
        margin-bottom: 20px;
    }
</style>
@section('content')

    <h1>Ajouter Voiture</h1>
    {!! Form::open(['method'=>'post','files'=>true, 'url'=>('addCars') ])!!}
    <div class="form-group">
        {!! Form::label('model','Modele') !!}
        {!! Form::text('model', '',['class'=>'form-control', 'placeholder'=>'Modele de la voiture']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('picture','Photo') !!}
        {!! Form::file('picture',array('multiple'=>true)) !!}
    </div>
    <div class="form-group">
        {!! Form::label('video','Video') !!}
        {!! Form::text('video', '',['class'=>'form-control', 'placeholder'=>'Lien de la video']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('basic_price','Prix basique') !!}
        {!! Form::text('basic_price', '',['class'=>'form-control', 'placeholder'=>'Modele de la voiture']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('test_drive','Test Drive') !!}<br>

        {!! Form::radio('test_drive', '1', null, ['id'=>''])!!}
        {!! Form::label('oui','Oui') !!}

        {!! Form::radio('test_drive', '0', null, ['id'=>''])!!}
        {!! Form::label('non','Non') !!}
    </div>

    <hr>

    @foreach($categories as $c)
        @if (isset($c))
            @if (isset($options[$c->id]))
                <h3>Categorie : {{$c->name_category}}</h3>


                {!! Form::hidden('cat-'.$c->id,1) !!}


                <div id="parent-{{$c->id}}" class="rows" data-id="{{$c->id}}">
                    <div class="row to-copy line-input">
                        <div class="col-md-9">
                            {!! Form::label('','Option :') !!}

                            {!! Form::select('option', $options[$c->id], null, ['class'=>'form-control']) !!}

                        </div>

                        <div class="col-md-3">
                            {!! Form::label('','Prix :') !!}
                            {!! Form::text('', '',['class'=>'form-control price', 'placeholder'=>'Prix', 'name'=>'price-'.$c->id.'-1']) !!}
                        </div>

                    </div>
                    <div class="appendTo">

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2">
                            <button class="btn btn-info add-input" data-id="parent-{{$c->id}}"><i class="fa fa-plus" ></i>Ajouter</button>
                        </div>
                    </div>
                </div>

            @endif

        @endif


    @endforeach


    <button class="btn btn-success" type="submit">save</button>
    {!! Form::close()!!}
@stop







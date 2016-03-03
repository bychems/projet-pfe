@extends("default")
@section('title',$title)


@section('content')

    <h1>Ajouter Voiture</h1>
    {!! Form::open(['method'=>'post','file'=>true, 'url'=>('cars/add-car') ])!!}
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

    {!! Form::hidden('tab_option', "") !!}
    @if(isset($categories))
    @foreach($categories as $c)
        @if (isset($c))
            @if (isset($options[$c->id]))
            <h3>Categorie : {{$c->name_category}}</h3>

            <div id="parent-{{$c->id}}" class="rows" data-id="{{$c->id}}">
                <div class="row to-copy line-input">
                    <div class="col-md-6">
                        {!! Form::label('','Option :') !!}

                        {!! Form::select('option', $options[$c->id], null, ['class'=>'form-control', 'id'=>'option-select-'.$c->id]) !!}

                    </div>

                    <div class="col-md-6">
                        <button class="btn btn-info add-option haut" data-id="{{$c->id}}"><i class="fa fa-plus" ></i>Ajouter</button>
                    </div>

                </div>
                <div  id="new_option_{{$c->id}}">

                </div>
            </div>

            @endif

        @endif


    @endforeach
    @endif


    <button class="btn btn-success" type="submit">save</button>
    {!! Form::close()!!}
    @if($categories!=null)
        @foreach($categories as $c)
    <div class="hidden row" id="to-clone">
        <div class="col-md-4">
            <p class="option">test</p>
        </div>
        <div class="col-md-2">
            {!! Form::text('', '',['class'=>'form-control price', 'placeholder'=>'Prix','required'=>true]) !!}
        </div>
    </div>
    @endforeach
    @endif
@stop







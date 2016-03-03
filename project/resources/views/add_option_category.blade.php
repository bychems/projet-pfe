@extends("default")
@section('title',$title)

@section('content')
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

        .rows .row {
            margin-bottom: 20px;
        }
        .hidden{
            display: none;
        }
        p{
            padding:6px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #D8D8D8;
        }
        .btn-info.add-option {
            margin-top: 25px;
        }
        .btn.btn-info.nouvelle_option {
            visibility:hidden;
        }
        .options-add-form:hover .nouvelle_option{
            visibility:visible;
        }


    </style>
    <h1>Ajouter Categorie</h1>
    {!! Form::open(['method'=>'post', 'url'=>'categories/add-categorie', 'class' => 'options-add-form'] )!!}
    <div class="form-group">
        {!! Form::label('nameL','Nom') !!}
        {!! Form::text('name_category', '',['class'=>'form-control', 'placeholder'=>'Nom de la Catégorie']) !!}
    </div>
    <div class="row">

        <div class="col-md-3">
            <div><label >&nbsp;</label></div>
            <button class="btn btn-info nouvelle_option" data-id=""><i class="fa fa-plus" ></i>Ajouter option</button>
        </div>
        {!! Form::hidden('tab_option', "") !!}
        <div class="col-md-9 new-option">

        </div>
    </div>
    <br>
    <button class="btn btn-success" type="submit">save</button>
    {!! Form::close()!!}

    @if(isset($categories))
        @foreach($categories as $c)
            @if (isset($c))
                <h3>Categorie : {{$c->name_category}}</h3>
                {!! Form::open(['method'=>'post', 'class'=>'form-options', 'url'=>route('addoption')])!!}
                @if (isset($opp[$c->id]))

                        @foreach($opp[$c->id] as $option)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div><strong>Options :</strong></div>
                                        <p>{{$option['nom']}} - Desc: {{$option['desc']}}</p>
                                    </div>
                                </div>

                        @endforeach
                            <div class="ajax"></div>
                            <div class="row">
                            <div class="col-md-12 new-option">

                            </div>
                            <div class="col-md-12">
                                <hr>
                                <button class="btn btn-info nouvelle_option" data-id="{{$c->id}}"><i class="fa fa-plus" ></i> Ajouter option</button>
                                <button class="btn btn-success pull-right" data-id=""><i class="fa fa-plus" ></i> Enregistrer</button>
                            </div>
                        </div>

                @endif
                {!! Form::hidden('nb_option') !!}
                {!! Form::hidden('category_id', $c->id) !!}
                {!! Form::close()!!}
            @endif
        @endforeach
    @endif



    <div class="hidden" id="to-clone">
        <div class="col-md-5">
            <div class="form-group">
                {!! Form::label('','Nom') !!}
                {!! Form::text('option_name', '',['class'=>'form-control price', 'placeholder'=>'Nom de loption']) !!}
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-group">
                {!! Form::label('','Description') !!}
                {!! Form::textarea('option_description', '',['class'=>'form-control price', 'placeholder'=>'Description de loption', 'rows'=>1]) !!}
            </div>
        </div>
    </div>

    <div class="hidden row" id="ajax-clone">
        <div class="col-md-2">
            {!! Form::label('','Option :') !!}
        </div>
        <div class="col-md-5">
            <p class="name"><b>Nom: </b></p>
        </div>
        <div class="col-md-5">
            <p class="desc"><b>Déscription: </b></p>
        </div>

    </div>
@stop

@section('js')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="{{url('../resources/assets/plugins/jquery.form.min.js')}}"></script>
@stop
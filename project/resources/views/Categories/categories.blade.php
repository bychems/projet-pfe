@extends("default")
@section('title',$title)



@section('banner')

    <div class="banner">
        <div class="container">
            <h2>Nouvelles <br> cat&egrave;gories / options </h2>
        </div>
    </div>

@stop

@section('content')
    <div class="row">
        <div class="col-md-8">


            <h1>Ajouter Cat&eacute;gorie</h1>
            {!! Form::open(['method'=>'post','files'=>true ,'url'=>route('categoryStore') ])!!}
            <div class="form-group">
                {!! Form::label('nameL','Nom') !!}
                {!! Form::text('name_category', '',['class'=>'form-control', 'placeholder'=>'Nom de la Cat&eacute;gorie']) !!}
            </div>
            <div class="row">
                <div class="form-group col-md-8">
                    {!! Form::label('IconeC','Icone') !!}
                    {!! Form::file('icon') !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    {!! Form::label('','Option :') !!}
                </div>
                <div class="col-md-3">
                    <button class="btn btn-info nouvelle_option" ><i class="fa fa-plus" ></i>Ajouter</button>
                </div>
                {!! Form::hidden('tab_option', "") !!}
                <div class="col-md-7 new_option" >
                </div>
            </div>
            <br>
            <button class="btn btn-success droite" >save</button>
            {!! Form::close()!!}
            @if(isset($categories))
                @foreach($categories as $c)
                    @if (isset($c))
                    <div class="cat_div">
                        <h3 class="form-delete">
                            <div class="row">
                                <div class="col-md-11">
                                    Categorie : {{$c->name_category}}
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="fa fa-times-circle suppCat {{$c->id}}" data-id="{{$c->id}}" type='submit' data-toggle="modal" data-target="#confirmDelete" data-title="Supprimer Cat&eacute;gorie" data-message='Etes vous sure de vouloir supprimer cette cat&eacute;gorie?'></button>
                                </div>
                            </div>
                        </h3>

                        @if (isset($opp[$c->id]))
                            @foreach($opp[$c->id] as $option)
                                <div class="row form-delete">
                                    <div class="col-md-2">
                                        {!! Form::label('','Option :') !!}
                                    </div>
                                    <div class="col-md-4">
                                        <p><b>Nom: </b>{{$option->name}}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <p><b>D&eacute;scription: </b>{{$option->description}}</p>
                                    </div>
                                    <div class="col-md-1">

                                        <button type="button" class="fa fa-times-circle suppOp {{$option->id}}"  type='submit' data-toggle="modal" data-target="#confirmDelete" data-title="Supprimer Option" data-message='Etes vous sure de vouloir supprimer cette option?' data-id="{{$option->id}}"></button>

                                    </div>
                                </div>

                            @endforeach
                        @endif
                        {!! Form::open(['method'=>'post', 'class'=>'form-options', 'url'=>route('addoption')])!!}
                        <div class="ajax"></div>
                        <div class="row">
                            <div class="col-md-12 new_option">
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <button class="btn btn-info option_nouvelle"><i class="fa fa-plus form" ></i> Ajouter option</button>
                                <button class="btn btn-success pull-right" data-id=""><i class="fa fa-plus" ></i> Enregistrer</button>
                            </div>

                            <input type="hidden" class="category_id" >
                            <input type="hidden" class="nb">
                        </div>
                        {!! Form::hidden('nb_option') !!}
                        {!! Form::hidden('category_id', $c->id) !!}
                        {!! Form::close()!!}
                    </div>
                    @endif
                @endforeach

            @endif
        </div>
    </div>
    <div class="hidden row" id="to-clone">

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('','Nom') !!}
                {!! Form::text('option_name', '',['class'=>'form-control name', 'placeholder'=>'Nom de l option']) !!}
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                {!! Form::label('','D&eacute;scription') !!}
                {!! Form::textarea('option_description', '',['class'=>'form-control description', 'placeholder'=>'D&eacute;scription de l option', 'rows'=>1]) !!}
            </div>
        </div>
    </div>

    <div class="hidden row form-delete" id="ajax-clone">
        <div class="col-md-2">
            {!! Form::label('','Option :') !!}
        </div>
        <div class="col-md-4">
            <p class="name"><b>Nom: </b></p>
        </div>
        <div class="col-md-5">
            <p class="desc"><b>D&eacute;scription: </b></p>
        </div>
        <div class="col-md-1">

            <button type="button" class="fa fa-times-circle suppOp" type='submit' data-toggle="modal" data-target="#confirmDelete" data-title="Supprimer Option" data-message='Etes vous sure de vouloir supprimer cette option?'></button>

        </div>

    </div>

    @include('delete_confirm')


@stop
@section('js')
    <script type="text/javascript">
        var route = "{{route('addoption')}}";
        var suppOpRoute="{{route('destroyOpt',0)}}";
        suppOpRoute = suppOpRoute.slice(0, - 1);
        var suppCatRoute="{{route('destroyCat',0)}}"
        suppCatRoute = suppCatRoute.slice(0, - 1);


        $('#confirmDelete').on('show.bs.modal', function (e) {
            $message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text($message);
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text($title);
            $id = $(e.relatedTarget).attr('data-id');

            // Pass form reference to modal for submission on yes/ok
            //var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-footer #confirm').data('id', $id);
        });

        <!-- Form confirm (yes/ok) handler, submits form -->
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function(e){
            e.preventDefault();

            $id=$(this).data('id');

            var Route=suppOpRoute+$id;
            var res= $('.'+$id).parent();

            $.ajax({
                url: Route,
                type: 'GET',
                data: '',
                dataType: 'text',
                success: function(response) {
                    res.parent().remove();

                },
                fail: function(response) {
                }
            });
        });


        $('#confirmDelete').on('show.bs.modal', function (e) {
            $message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text($message);
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text($title);
            $id = $(e.relatedTarget).attr('data-id');

            // Pass form reference to modal for submission on yes/ok
            //var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-footer #confirm').data('id', $id);
        });

        <!-- Form confirm (yes/ok) handler, submits form -->
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function(e){
            e.preventDefault();

            $id=$(this).data('id');

            var Route=suppCatRoute+$id;
            var res= $('.'+$id).parent();

            $.ajax({
                url: Route,
                type: 'GET',
                data: '',
                dataType: 'text',
                success: function(response) {
                    res.parent().parent().remove();

                },
                fail: function(response) {
                }
            });
        });


    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>

@stop
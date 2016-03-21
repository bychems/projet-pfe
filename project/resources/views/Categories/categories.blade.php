@extends("default")
@section('title',$title)

@section('content')

<div class="row">
    <div class="col-md-8">
        
  
<h1>Ajouter Catégorie</h1>
{!! Form::open(['method'=>'post', 'url'=>route('categoryStore') ])!!}
            <div class="form-group ">
                {!! Form::label('nameL','Nom') !!}
                {!! Form::text('name_category', '',['class'=>'form-control', 'placeholder'=>'Nom de la Catégorie']) !!}
            </div>
            <div class="row">
                    <div class="col-md-2">
                        {!! Form::label('','Option :') !!}
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-info nouvelle_option"><i class="fa fa-plus" ></i>Ajouter</button>
                    </div>
                             {!! Form::hidden('tab_option', "") !!}
                    <div class="col-md-7 new_option" >

                    </div>
            </div>
                     <br>
            <button class="btn btn-success droite" type="submit">save</button>
 {!! Form::close()!!}
            @if(isset($categories))
                       @foreach($categories as $c)
                           <div class="form-cat {{$c->id}}">
                        @if (isset($c))

                                <h3 class="form-delete ">
                                    <div class="row">
                                        <div class="col-md-10">
                                            Categorie : {{$c->name_category}}
                                        </div>
                                        <div class="col-md-1">
                                            <button  class="fa fa-pencil modifCat" data-id="{{$c->id}}" data-token="{{ csrf_token() }}"></button>
                                        </div>
                                        <div class="col-md-1">
                                            <button  class="fa fa-times-circle suppCat" data-id="{{$c->id}}" data-token="{{ csrf_token() }}"></button>
                                        </div>
                                    </div>
                                </h3>


                            @if (isset($opp[$c->id]))
                               @foreach($opp[$c->id] as $option)

                                             <div class="row form-delete op{{$option->id}}">
                                                <div class="col-md-2">
                                                {!! Form::label('','Option :') !!}
                                                </div>
                                                <div class="col-md-3">
                                                    <p><b>Nom: </b>{{$option->name}}</p>
                                                </div>
                                                <div class="col-md-5">
                                                     <p><b>Déscription: </b>{{$option->description}}</p>
                                                </div>
                                                 <div class="col-md-1">
                                                     <button  class="fa fa-pencil modifOpt" data-id="{{$c->id}}" data-token="{{ csrf_token() }}"></button>
                                                 </div>
                                                <div class="col-md-1">
                                                    <button  class="fa fa-times-circle suppOpt" data-id="{{$option->id}}" data-token="{{ csrf_token() }}"></button>
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
                            @endif
                           </div>
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
            {!! Form::label('','Déscription') !!}
             {!! Form::textarea('option_description', '',['class'=>'form-control description', 'placeholder'=>'Déscription de l option', 'rows'=>1]) !!}
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
<script type="text/javascript">


    var route = "{{route('addoption')}}";


    DeleteCatRoute= "{{route('destroyCat',0)}}";
    DeleteCatRoute = DeleteCatRoute.slice(0, -1);


    DeleteOptRoute= "{{route('destroyOpt',0)}}";
    DeleteOptRoute = DeleteOptRoute.slice(0, -1);

</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>

@stop
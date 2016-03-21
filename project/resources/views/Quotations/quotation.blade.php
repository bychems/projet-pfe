@extends("default")
@section('title',$title)

@section('content')


    <h1>Creation d'un devis</h1>
    <br>
    <div class="col-md-3">
        {!! Form::label('','Modele :') !!}
        {!! Form::select('modele', $car,null,['class'=>'form-control option','name'=>'car-'.$car->id]) !!}
    </div>
    <h4>Categories d'options disponibles pour cette voiture</h4>
    @if(isset($categories))
        @foreach($categories as $c)
            @if (isset($c))
                @if (isset($opp[$c->id]))
                    <div class="row">
                        <div class="col-md-8">
                    <h3>Categorie : {{$c->name_category}}</h3>
                        </div>
                    </div>

                    <div id="parent-{{$c->id}}" class="rows">
                        <div class="row to-copy line-input">


                            <div class="col-md-6 btn-group" data-toggle="buttons">
                                @foreach($opp[$c->id] as $opt)
                                    <label class="btn btn-primary active">
                                        <input type="radio" date-name="" data-id="" data-price=""  autocomplete="off"> {{$opt}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
        <button class="btn btn-success droite" type="submit">Creer Devis</button>
    @endif



@stop
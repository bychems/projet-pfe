@extends("default")
@section('title',$title)
@section('content')


    <h1>

            Voiture: {{$car->model}}

    </h1>
    {!! Form::open(['method'=>'POST', 'url'=>'', 'class'=>'form-devis'])!!}
   <div class="form-detail">

    @foreach($categories as $category)

        <h3>{{$category['name']}}</h3>


        <div class="btn-group" data-toggle="buttons">
            @foreach($category['options'] as $option)

                <label class="btn btn-primary ">
                    <input type="radio" value="{{$option['name']}}"  data-category="{{$category['name']}}" data-name="{{$option['name']}}" data-description="{{$option['description']}}" data-price="{{$option['price']}}" id="id-devis" class="opt-checked"> {{$option['name']}}
                </label>

            @endforeach
        </div>

    @endforeach

    <br><br><br><br>
    <a href="#devis"><button class="btn btn-success droite create-devis" data-price-car="{{$car->basic_price}}"> Create </button></a>


        <h1 id="devis">Apercu du devis</h1><hr>
        <div class="row">
            <div class="col-md-2">
                <strong>Modele choisi : </strong>
            </div>
            <div class="col-md-3">
                <strong>{{$car->model}}</strong>
            </div>
        </div>

        <hr>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">OPTIONS CHOISIES</div>
            <!-- Table -->
            <table class="table">
                <thead>
                <tr>
                    <th>Nom Option</th>
                    <th>Description Option</th>
                    <th>Prix Option</th>
                </tr>
                </thead>
                <tbody class="table_option">

                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-md-3">
                <strong>Prix de la voiture : </strong>
            </div>

            <div class="col-md-4">
                {{$car->basic_price}} DT
            </div>
        </div>



        <div class="row">
            <div class="col-md-3">
                <strong>TVA(18%) : </strong>
            </div>

            <div class="col-md-4">
                {{$car->basic_price*0.18}} DT
            </div>
        </div>



        <div class="row">
            <div class="col-md-3">
                <strong>Frais d'immatriculation : </strong>
            </div>

            <div class="col-md-4">
                 236,500 DT
            </div>
        </div>



        <div class="row">
            <div class="col-md-3">
                <strong>T.M.E : </strong>
            </div>

            <div class="col-md-4">
                500 DT
            </div>
        </div>



        <div class="row">
            <div class="col-md-3">
                <strong>Frais de timbre : </strong>
            </div>

            <div class="col-md-4">
                0,500 DT
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-3">
                <strong>Prix totale des options : </strong>
            </div>

            <div class="col-md-4 prix_tot_opt">
                0 DT
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-3">
                <strong>Prix de vente T.T.C : </strong>
            </div>

            <div class="col-md-4 prix_tot_car">
                {{$car->basic_price+$car->basic_price*0.18+236.500+500+0.500}} DT
            </div>
        </div>
     
    </div>

    {!! Form::close()!!}


@stop
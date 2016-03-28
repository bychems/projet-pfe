@extends("default")
@section('title',$title)
@section('content')
<div class="row">
<div class="col-md-4">
    <h1>

            Voiture: {{$car->model}}

    </h1>
    <!-- Wrapper for slides -->
    <div class="owl-carousel">
        @foreach(json_decode($car->picture) as $pic)
            <div class="item ">
                <img src="{{url('project/uploads').'/'.$pic}}" alt="image">
            </div>
        @endforeach
    </div>
</div>



    <div class="col-md-8">
    {!! Form::open(['method'=>'GET', 'url'=>route('Calendar', $car->id), 'class'=>'form-devis'])!!}
    <button class="btn btn-success droite" type="submit"> CALENDRIER </button>
    {!! Form::close() !!}
</div>
</div>

@if (isset($categories))
    {!! Form::open(['method'=>'POST', 'class'=>'form-devis'])!!}
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
           </div>
    {!! Form::close()!!}

    <br><br><br><br>


    <a href="#devis"><button class="btn btn-success droite create-devis" data-price-car="{{$car->basic_price}}"> Create </button></a>


    {!! Form::open(['method'=>'POST', 'url'=>route('devisStore', $car->id), 'class'=>'form-devis'])!!}
    {!! Form::hidden('list_option', "",['id'=>'list_options']) !!}
        <h1 id="devis">Apercu du devis</h1><hr>
        <div class="row">
            <div class="col-md-2">
                <strong>Mod&egrave;le choisi : </strong>
            </div>
            <div class="col-md-3">
                {!! Form::hidden('model', $car->model) !!}
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

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">PRIX FINAL</div>
        <table class="table">
            <tbody>
            <tr>
                <td><strong>Prix de la voiture : </strong></td>
                {!! Form::hidden('basic_price', $car->basic_price) !!}
                <td>{{$car->basic_price}} DT</td>
            </tr>
            <tr>
                <td><strong>TVA(18%) : </strong></td>
                {!! Form::hidden('tva', $car->basic_price*0.18) !!}
                <td> {{$car->basic_price*0.18}} DT</td>
            </tr>
            <tr>
                <td><strong>Frais d'immatriculation : </strong></td>
                {!! Form::hidden('frais_imm', "236,500") !!}
                <td>  236,500 DT</td>
            </tr>
            <tr>
                <td> <strong>T.M.E : </strong></td>
                {!! Form::hidden('tme', "500") !!}
                <td>  500 DT</td>
            </tr>
            <tr>
                <td>  <strong>Frais de timbre : </strong></td>
                {!! Form::hidden('frais_timbre',"0,500") !!}
                <td>   0,500 DT</td>
            </tr>
            <tr>
                <td> <strong>Prix totale des options :  </strong></td>
                {!! Form::hidden('prix_options', "",['id'=>'prix_options']) !!}
                <td class="prix_tot_opt">  0 DT</td>
            </tr>
            <tr>
                <td> <strong>Prix de vente T.T.C :  </strong></td>
                {!! Form::hidden('prix_total_voiture', $car->basic_price+$car->basic_price*0.18+236.500+500+0.500) !!}
                <td class="prix_tot_car">   {{$car->basic_price+$car->basic_price*0.18+236.500+500+0.500}} DT</td>
            </tr>
            </tbody>
        </table>
        </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                {!! Form::label('',' Client:') !!}
                {!! Form::select('customers', $customers,null,['class'=>'form-control ']) !!}
            </div>
        </div>
    </div>

        <button type="submit" class="btn btn-success droite"> Envoyer </button>

    {!! Form::close()!!}

@endif


@stop
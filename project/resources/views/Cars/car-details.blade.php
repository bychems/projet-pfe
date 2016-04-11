@extends("default")
@section('title',$title)

@section('banner')

    <div class="banner">
        <div class="container">
            <div class="col-md-3" style="text-align: center"><h2>D&eacute;tail Voiture</h2></div>
        </div>
    </div>

@stop

@section('content')

    <div class="row">
        <div class="col-md-10">
            <h1>
                    Voiture: {{$car->model}}
            </h1>
            <!-- Wrapper for slides -->
            <div class="owl-carousel ">
                @foreach(json_decode($car->picture) as $pic)
                    <div class="item ">
                        <img src="{{url('project/uploads').'/'.$pic}}" alt="image">
                    </div>
                @endforeach
            </div>
        </div>


    </div>

    <hr>

    <div class="row">
        <div class="col-md-2">
            <strong>Vid&eacute;o Youtube : </strong>
        </div>
        <div class="col-md-3">

            <a href="{{$car->video}}"> <strong>{{$car->video}}</strong> </a>
        </div>
    </div>

    <hr>


    @if (isset($categories))
        {!! Form::open(['class'=>'form-devis','url'=>route('devisStore')])!!}
        {!! Form::hidden('id_car', $car->id,['id'=>'id_car']) !!}
        {!! Form::hidden('car_model', $car->model,['id'=>'car_model']) !!}
        <div class="row milieu">
        <div class="form-detail">

                @foreach($categories as $category)

                    <h3>{{$category['name']}}</h3>



                    <div class="btn-group milieu" data-toggle="buttons">
                        @foreach($category['options'] as $option)

                            <label class="btn btn-primary ">
                                <input type="radio" value="{{$option['name']}}"  data-category="{{$category['name']}}" data-name="{{$option['name']}}" data-description="{{$option['description']}}" data-price="{{$option['price']}}" id="id-devis" class="opt-checked"> {{$option['name']}}
                            </label>

                        @endforeach
                    </div>

                @endforeach
               </div>
            </div>


        <br><br><br><br>

        <div class="milieu">
            <a href="#devis"><button class="btn btn-success create-devis" data-price-car="{{$car->basic_price}}"> Create </button></a>
        </div>


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
                    {!! Form::hidden('basic_price', $car->basic_price, ['id'=>'basic_price']) !!}
                    <td>{{$car->basic_price}} DT</td>
                </tr>
                <tr>
                    <td><strong>TVA(18%) : </strong></td>
                    {!! Form::hidden('tva', $car->basic_price*0.18, ['id'=>'tva']) !!}
                    <td> {{$car->basic_price*0.18}} DT</td>
                </tr>
                <tr>
                    <td><strong>Frais d'immatriculation : </strong></td>
                    {!! Form::hidden('frais_imm', "236,500", ['id'=>'frais_imm']) !!}
                    <td>  236,500 DT</td>
                </tr>
                <tr>
                    <td> <strong>T.M.E : </strong></td>
                    {!! Form::hidden('tme', "500", ['id'=>'tme']) !!}
                    <td>  500 DT</td>
                </tr>
                <tr>
                    <td>  <strong>Frais de timbre : </strong></td>
                    {!! Form::hidden('frais_timbre',"0,500", ['id'=>'frais_timbre']) !!}
                    <td>   0,500 DT</td>
                </tr>
                <tr>
                    <td> <strong>Prix totale des options :  </strong></td>
                    {!! Form::hidden('prix_options', "",['id'=>'prix_options']) !!}
                    <td class="prix_tot_opt">  0 DT</td>
                </tr>
                <tr>
                    <td> <strong>Prix de vente T.T.C :  </strong></td>
                    {!! Form::hidden('prix_total_voiture', $car->basic_price+$car->basic_price*0.18+236.500+500+0.500,['id'=>'total_price_car']) !!}
                    <td class="prix_tot_car">   {{$car->basic_price+$car->basic_price*0.18+236.500+500+0.500}} DT</td>
                </tr>
                </tbody>
            </table>
            </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-4 select_customer">
                    {!! Form::label('',' Client:') !!}

                    {!! Form::select('id_customers', $customers,null,['class'=>'form-control','id'=>'id_customer']) !!}
                </div>
                <div class="col-md-4">
                  <label>{!! Form::checkbox('chk_new_customer', 0, null,['class'=>'chk_new_customer']) !!}Nouveau client</label>

                </div>
            </div>
        </div>





        <div class="hidden" id="new_customer_div">
        <h1>Ajouter Client</h1>

        <div class="contenu">


            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>

            @endif


            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('','Nom') !!}
                    {!! Form::text('name', '',['class'=>'form-control', 'placeholder'=>'Nom du client']) !!}
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('','Pr&eacute;nom') !!}
                    {!! Form::text('last_name', '',['class'=>'form-control', 'placeholder'=>'Pr&eacute;nom du client']) !!}
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('','Cin') !!}
                    {!! Form::text('cin', '',['class'=>'form-control', 'placeholder'=>'Num CIN']) !!}
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('','Email') !!}
                    {!! Form::text('mail', '',['class'=>'form-control', 'placeholder'=>'Email du client']) !!}
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('','Adresse') !!}
                    {!! Form::text('adress', '',['class'=>'form-control', 'placeholder'=>'Adresse du client']) !!}
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('','Fonction') !!}<br>
                    {!! Form::text('function', '',['class'=>'form-control', 'placeholder'=>'Fonction du client']) !!}
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('','T&eacute;l&eacute;phone') !!}<br>
                    {!! Form::text('phone', '',['class'=>'form-control', 'placeholder'=>'T&eacute;l&eacute;phone du client']) !!}
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('','Voiture') !!}<br>
                    {!! Form::text('car', '',['class'=>'form-control', 'placeholder'=>'Voiture du client']) !!}
                </div>
            </div>


        </div>

        </div>
        <button class="btn btn-success droite send_quotation"> Envoyer </button>
        {!! Form::close() !!}

    @endif


@stop

@section('js')
    <script>
       var storeDevisRoute= "{{route('devisStore')}}";
       $(document).ready(function(){
           testConnection();
       });
     </script>
@stop
@extends("default")
@section('title',$title)

@section('banner')

    <div class="banneer">
        <div class="container">
            <div class="col-md-3" style="text-align: center">
                <h2>Ajouter Client</h2>
            </div>
        </div>
    </div>

@stop

@section('content')



    {!! Form::open(['id'=>'form_customer'])!!}
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

                            <div class="row" style="margin-left: 80px">
                                <div class="form-group col-md-5">
                                    {!! Form::label('','Nom',['class'=>'control-label']) !!}
                                    {!! Form::text('name', '',['class'=>'form-control', 'placeholder'=>'Nom du client', 'required'=>true]) !!}
                                </div>
                                <div class="form-group col-md-5">
                                    {!! Form::label('','Pr&eacute;nom') !!}
                                    {!! Form::text('last_name', '',['class'=>'form-control', 'placeholder'=>'Pr&eacute;nom du client', 'required'=>true]) !!}
                                </div>
                            </div>

                            <div class="row" style="margin-left: 80px">
                                <div class="form-group col-md-5">
                                    {!! Form::label('','Cin') !!}
                                    {!! Form::text('cin', '',['class'=>'form-control', 'placeholder'=>'Num CIN', 'required'=>true]) !!}
                                </div>
                                <div class="form-group col-md-5">
                                    {!! Form::label('','Email') !!}
                                    {!! Form::text('mail', '',['class'=>'form-control', 'placeholder'=>'Email du client', 'required'=>true]) !!}
                                </div>
                            </div>

                            <div class="row" style="margin-left: 80px">
                                <div class="form-group col-md-5">
                                    {!! Form::label('','Adresse') !!}
                                    {!! Form::text('adress', '',['class'=>'form-control', 'placeholder'=>'Adresse du client', 'required'=>true]) !!}
                                </div>
                                <div class="form-group col-md-5">
                                    {!! Form::label('','Fonction') !!}<br>
                                    {!! Form::text('function', '',['class'=>'form-control', 'placeholder'=>'Fonction du client', 'required'=>true]) !!}
                                </div>
                            </div>

                            <div class="row" style="margin-left: 80px">
                                <div class="form-group col-md-5">
                                    {!! Form::label('','T&eacute;l&eacute;phone') !!}<br>
                                    {!! Form::text('phone', '',['class'=>'form-control', 'placeholder'=>'T&eacute;l&eacute;phone du client', 'required'=>true]) !!}
                                </div>
                                <div class="form-group col-md-5">
                                    {!! Form::label('','Voiture') !!}<br>
                                    {!! Form::text('car', '',['class'=>'form-control', 'placeholder'=>'Voiture du client']) !!}
                                </div>
                            </div>

                            <div class="row" style="margin-left: 80px">
                                <div class="col-md-8">
                                   <button class="btn btn-success save" >Enregistrer</button>
                                </div>
                            </div>

            </div>
   </div>
    {!! Form::close()!!}



@stop


@section('js')
    <script>

        storeCustomerRoute= "{{route('addcustomer')}}";

    </script>






        <script   src="https://code.jquery.com/jquery-1.12.2.min.js"   integrity="sha256-lZFHibXzMHo3GGeehn1hudTAP3Sc0uKXBXAzHX1sjtk="   crossorigin="anonymous"></script>
    <script type="text/javascript">

        window.addEventListener('load', function() {
            var status = document.getElementById("status");

            function updateOnlineStatus(event) {
                var condition = navigator.onLine ? "online" : "offline";

                status.className = condition;
                status.innerHTML = condition.toUpperCase();

            }

            window.addEventListener('online',  updateOnlineStatus);
            window.addEventListener('offline', updateOnlineStatus);
        });
    </script>

    <script src="{{ asset('project/resources/assets/plugins/upup/upup.min.js') }}"></script>
    <script>
        UpUp.start({
            'content-url': 'http://localhost:90/projet-laravel/dashboard/customers',
            'assets': // Save the following files to cache as well
                 //   ['css/offline.css', 'css/bootstrap.min.css', 'img/mb-offline.png', 'img/logo.png', 'img/sunset.jpg'],
                    ['http://www.eryk.fr/wp-content/uploads/2016/03/Audi-1.jpg']

        });
    </script>

@stop
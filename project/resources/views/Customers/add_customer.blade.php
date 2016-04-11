@extends("default")
@section('title',$title)

@section('banner')

    <div class="banner">
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

    <div class="row">
        <div class="col-md-8">
           <button class="btn btn-success save" >Enregistrer</button>
        </div>
    </div>
</div>
    {!! Form::close() !!}

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

    <script src="//cdnjs.cloudflare.com/ajax/libs/UpUp/0.2.0/upup.min.js"></script>
    <script>
        UpUp.start({
            'content-url': 'http://localhost:90/projet-laravel/dashboard/customers',

            'service-worker-url': '/upup.sw.min.js'
        });
    </script>

@stop
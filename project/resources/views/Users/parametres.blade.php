@extends("default")
@section('title',$title)

@section('banner')

    <div class="banner">
        <div class="container">
            <div class="col-md-3" style="text-align: center">
                <h2>Param&eacute;tres du compte</h2>
            </div>
        </div>
    </div>

@stop

@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Vos informations personnelles</strong></div>

                <div class="panel-body">
                    {!! Form::open(['method'=>'put','class'=>'form-horizontal','role'=>'form', 'url'=>route('updateUser',Auth::user()->id) ])!!}

                        <div class="form-group">

                            <label class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <output type="text" class="form-control" name="nom" style="background-color: #D8D8D8">{{$nom_prenom}}</output>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <output type="text" class="form-control" placeholder="Email du client" name="email" style="background-color: #D8D8D8">{{$email}}</output>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Telephone</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" placeholder="Telephone du client" name="phone" value="{{$phone}}">
                            </div>
                        </div>

                        <br>


                        <div class="form-group">
                            <label class="col-md-4 control-label">Mot de passe</label>

                            <div class="col-md-6">
                                <input type="password" id="pass" class="form-control" placeholder="Nouveau password" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Confirmez mot de passe</label>

                            <div class="col-md-6">
                                <input type="password" id="pass_confirm" class="form-control" placeholder="Confirmer password" name="confirm_password">
                            </div>
                        </div>


                        <div class="form-group">


                            <div class="col-md-6 droite">
                                <input type="checkbox" name="chk_password" onchange="[document.getElementById('pass').type = this.checked ? 'text' : 'password',document.getElementById('pass_confirm').type = this.checked ? 'text' : 'password']"> Afficher mot de passe
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary droite" > Enregistrer </button>
                            </div>
                        </div>

                    {!! Form::close()!!}
                </div>
            </div>
        </div>
</div>


@stop
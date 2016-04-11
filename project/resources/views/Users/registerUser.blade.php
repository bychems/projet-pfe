@extends("default")
@section('title',$title)

@section('banner')

    <div class="banner">
        <div class="container">
            <div class="col-md-3" style="text-align: center">
                <h2>Ajouter utilisateur</h2>
            </div>
        </div>
    </div>

@stop

@section('content')


    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Ajout nouveau utilisateur</strong></div>

                <div class="panel-body">
                    {!! Form::open(['method'=>'post', 'class'=>'form-horizontal', 'url'=>route('storeUser') ])!!}
                        <div class="form-group">
                            <label class="col-md-4 control-label">Role</label>

                            <div class="col-md-6">
                                {!! Form::select('role', $roles,null,['class'=>'form-control ']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Nom</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Nom et prenom du client" name="nom_prenom">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Email du client" name="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Password du client"  name="password" style="background-color: #D8D8D8" value="000000" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary droite">
                                    <i class="fa fa-btn fa-user"></i>Ajouter
                                </button>
                            </div>
                        </div>
                    {!! Form::close()!!}
                </div>
            </div>
        </div>
    </div>


@stop
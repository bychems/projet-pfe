@extends("default")
@section('title',$title)

@section('banner')

    <div class="banner">
        <div class="container">
            <div class="col-md-3" style="text-align: center">
                <h2>Profil</h2>
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
                            <label class="col-md-4 control-label">Nom</label>

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
                                <output type="text" class="form-control" placeholder="Telephone du client" name="phone"  style="background-color: #D8D8D8">{{$phone}}</output>
                            </div>
                        </div>






                    {!! Form::close()!!}
                </div>
            </div>
        </div>
</div>


@stop
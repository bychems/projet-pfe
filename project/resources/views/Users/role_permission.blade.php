@extends("default")
@section('title',$title)

@section('banner')

    <div class="banner">
        <div class="container">
            <div class="col-md-3" style="text-align: center">
                <h2> Role - Permission </h2>
            </div>
        </div>
    </div>

@stop

@section('content')

    {!! Form::open(['method'=>'post', 'class'=>'form-horizontal', 'url'=>route('storeRole') ])!!}
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Ajout nouveau role</strong></div>
                <br>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 milieu">
                            {!! Form::label('role','Nom du role:') !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::text('role' ,null,['class'=>'form-control']) !!}
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary droite add_role">Enregistrer</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {!! Form::close()!!}


    {!! Form::open(['method'=>'post', 'class'=>'form-horizontal', 'url'=>route('storeRolePermission') ])!!}
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Ajout Permissions pour les roles</strong></div>
                    <br>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 milieu">
                            {!! Form::label('role','Choisissez le role') !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::select('roles', $roles ,null,['class'=>'form-control select_role','id'=>'id_role']) !!}
                        </div>
                    </div>
                </div>

                <br>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3 milieu">
                            {!! Form::label('permission','Permissions: ') !!}
                        </div>
                    </div>
                    <div class="row chk-group" style="margin-left: 5px">
                        @foreach($permissions as $permission)
                            <div class="col-md-4">
                                <label>{!! Form::checkbox('chk_permission[]', $permission->id, null,['class'=>'chk_new_permission','id'=>$permission->id]) !!}{{$permission->display_name}}</label>
                            </div>
                        @endforeach
                    </div>


                </div>

            </div>
        </div>

        <br>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary droite add_perm_role">Enregistrer</button>
            </div>
        </div>


    </div>
    {!! Form::close()!!}


@stop

@section('js')
    <script type="text/javascript">

        var getRolePermission="{{route('getRolePermission',array(0,0))}}";
        getRolePermission = getRolePermission.slice(0, - 3);


    </script>
@stop
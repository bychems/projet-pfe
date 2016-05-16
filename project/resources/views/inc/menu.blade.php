<nav class="navbar navbar-inverse" style="border-radius: 0px; margin-bottom: 0px">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">AUDI</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{route('home')}}">Accueil</a></li>
                @permission('profilUser')<li><a href="{{route('profilUser')}}">Profil</a></li>@endpermission
                <li class="dropdown">
                    @permission('carList')<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Voitures <span class="caret"></span></a>@endpermission
                    <ul class="dropdown-menu">
                        @permission('carIndex')<li><a href="{{route('carIndex')}}">Ajouter Voiture</a></li>@endpermission
                        @permission('carList')<li><a href="{{route('carList')}}">Voitures</a></li>@endpermission
                        @permission('carIndex')<li role="separator" class="divider"></li>@endpermission
                        @permission('categoryIndex')<li><a href="{{route('categoryIndex')}}" >Categories et Options</a></li>@endpermission
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('list_quotations')}}">Liste Devis</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    @permission('addcustomerIndex')<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clients <span class="caret"></span></a>@endpermission
                <ul class="dropdown-menu">
                    @permission('addcustomerIndex')<li><a href="{{route('addcustomerIndex')}}">Ajouter Clients</a></li>@endpermission
                    @permission('addcustomerIndex')<li role="separator" class="divider"></li>@endpermission
                    @permission('listCustomers')<li><a href="{{route('listCustomers')}}">Liste des clients</a></li>@endpermission
                </ul>
                </li>
                <li class="dropdown">
                    @permission('carListTestDrive')<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Test Drive <span class="caret"></span></a>@endpermission
                    <ul class="dropdown-menu">
                        @permission('testDriveIndex')<li><a href="{{route('testDriveIndex')}}">Ajouter Disponibilite</a></li>@endpermission
                        @permission('testDriveIndex')<li role="separator" class="divider"></li>@endpermission
                        @permission('carListTestDrive')<li><a href="{{route('carListTestDrive')}}">Voitures Test Drive</a></li>@endpermission
                    </ul>
                </li>
               <li class="dropdown">
                   @permission('addUser')<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Utilisateurs <span class="caret"></span></a>@endpermission
                    <ul class="dropdown-menu">
                        @permission('addUser')<li><a href="{{route('addUser')}}">Ajouter Utilisateur</a></li>@endpermission
                       <li><a href="{{route('list_users')}}">Liste Utilisateurs</a></li>
                        @permission('addUser')<li><a href="{{route('addRolePermission')}}">Role / Permission</a></li>@endpermission
                    </ul>
                </li>
                <li class="dropdown">
                    @permission('OfflineCustomerIndex')<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Demandes <span class="notif_all hidden"></span><span class="caret"></span></a>@endpermission
                    <ul class="dropdown-menu">
                        @permission('OfflineCustomerIndex') <li><a href="{{route('OfflineCustomerIndex')}}">Nouveaux clients <span class="notif_c hidden"></span></a></li>@endpermission
                        @permission('OfflineQuotationIndex')<li><a href="{{route('OfflineQuotationIndex')}}">Nouveaux devis <span class="notif_d hidden"></span></a></li>@endpermission
                    </ul>
                </li>


            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Connexion</a></li>
                    <li><a href="{{ url('/register') }}">Inscription</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/dashboard/parametresuser') }}"><i class="fa fa-cogs" ></i> Param&egrave;tres</a></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Se d&eacute;connecter</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
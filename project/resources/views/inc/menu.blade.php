<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Projet PFE</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{route('home')}}">Accueil</a></li>
                <li><a href="{{route('profilUser')}}">Profil</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Voitures <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('carIndex')}}">Ajouter Voiture</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('carList')}}">Voitures</a></li>
                        <li><a href="{{route('carListTestDrive')}}">Voitures Test Drive</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('categoryIndex')}}" >Categories et Options</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clients <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{route('addcustomerIndex')}}">Ajouter Clients</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{route('listCustomers')}}">Liste des clients</a></li>
                </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Test Drive <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('testDriveIndex')}}">Ajouter Disponibilite</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('carListTestDrive')}}">Voitures Test Drive</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Utilisateurs <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('addUser')}}">Ajouter Utilisateur</a></li>
                    </ul>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
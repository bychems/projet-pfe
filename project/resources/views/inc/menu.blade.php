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
                <li class="active"><a href="{{route('addcarIndex')}}">Ajout Voiture</a></li>
                <li><a href="{{route('listCars')}}">Liste Voitures</a></li>
                <li><a href="{{route('addcategorieIndex')}}">Ajout Opt Cat</a></li>
                <li><a href="{{route('addcustomerIndex')}}">Ajout Client</a></li>
                <li><a href="{{route('listCustomers')}}">liste Clients</a></li>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
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
                <li class="active"><a href="{{route('carIndex')}}">Ajout Voiture</a></li>
                <li><a href="{{route('carList')}}">Liste Voitures</a></li>
                <li><a href="{{route('categoryIndex')}}">Ajout Opt Cat</a></li>
                <li><a href="{{route('addcustomerIndex')}}">Ajout Client</a></li>
                <li><a href="{{route('listCustomers')}}">liste Clients</a></li>
                <li><a href="{{route('testDriveIndex')}}">Test Drive</a></li>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
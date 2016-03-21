
<!DOCTYPE html>
<html lang="en">

@include ('inc.head')

  <body>
  @include ('inc.menu')

  <div class="container">
    <div class="row">
      <div class="col-md-9">
        @yield('content')
      </div>


    <div class="col-md-3">
      <?php
      $customers = App\Customer::all();
      ?>
        <h3>Clients : </h3>

          <ul class="client">
            @foreach($customers as $customer)
              @if(!empty($customer->name))
                <li><a href="{{route('afficheCustomer', $customer->id)}}">{{ $customer->name }} {{$customer->last_name}}</a></li>
              @endif
            @endforeach
          </ul>

        <h3>Quoi faire? </h3>
        <div class="list-group">
          <a href="{{route('carIndex')}}" class="list-group-item active" onclick="activate(this)">Ajouter voiture</a>
          <a href="{{route('carList')}}" class="list-group-item" onclick="activate(this)">Afficher liste des voitures</a>
          <a href="{{route('carListTestDrive')}}" class="list-group-item" onclick="activate(this)">Afficher voitures Dispo test drive</a>
          <a href="{{route('categoryIndex')}}" class="list-group-item" onclick="activate(this)">Ajouter Categories et Options</a>
          <a href="{{route('addcustomerIndex')}}" class="list-group-item">Ajouter Clients</a>
          <a href="{{route('listCustomers')}}" class="list-group-item">Afficher liste des clients</a>
          <a href="{{route('testDriveIndex')}}" class="list-group-item">Ajouter disponibilites test Drive</a>

        </div>



    </div>
      </div>

  </div><!-- /.container -->


  @include('inc.js')
  </body>
</html>
<script>
var current;
var activate = function(el) {
if (current) {
current.classList.remove('active');
}
current = el;
el.classList.add('active');
}
</script>
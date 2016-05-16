
<!DOCTYPE html>
<html lang="en" >


@include ('inc.head')

  <body>
  @include ('inc.menu')
  @yield('banner')
  <div class="container">

    <div class="row">
      <div class="col-md-9 haut">
        @yield('content')
      </div>

      <div class="col-md-3">

        <?php
        $customers = \App\Customer::GetCustomerAsUser(Auth::user()->id)->get();
        ?>

        <h3>Clients : </h3>

        <ul class="client">
          @if(isset($customers))
              @foreach($customers as $customer)
                @if(!empty($customer->name))
                  <li><a href="{{route('afficheCustomer', $customer->id)}}" title="D&eacute;tail">{{ $customer->name }} {{$customer->last_name}}</a></li>
                @endif
              @endforeach
          @endif
        </ul>




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

<!DOCTYPE html>
<html lang="en">

@include ('inc.head')

  <body>


    @include ('inc.menu')
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          @yield('content')
        </div>
      </div>

      <div class="col-md-4">
        @yield('side-bar')
      </div>

    </div><!-- /.container -->


  @include('inc.js')
  </body>
</html>

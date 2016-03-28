<!DOCTYPE html>
<html lang="en">

@include('inc.head')
<body>

@include('inc.menu')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @yield('content')
        </div>

    </div>
</div><!-- /.container -->




@include('inc.js');


</body>
</html>
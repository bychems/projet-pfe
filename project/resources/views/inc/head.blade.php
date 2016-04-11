<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->

    {!! HTML::style('project/resources/assets/font-awesome/css/font-awesome.min.css') !!}
    {!! HTML::style('project/resources/assets/dist/css/bootstrap.min.css') !!}

    {!! HTML::style('project/resources/assets/plugins/datePicker/css/datepicker.css') !!}
    {!! HTML::style('project/resources/assets/plugins/calendar/bootstrap-datetimepicker.min.css') !!}

    {!! HTML::style('project/resources/assets/plugins/datatables/css/jquery.dataTables.min.css') !!}


    {!! HTML::style('project/resources/assets/plugins/notification/css/jquery.ambiance.css') !!}

    {!! HTML::style('project/resources/assets/css/style.css') !!}

    {!! HTML::style('project/resources/assets/plugins/owl.carousel/owl.carousel.css') !!}
    {!! HTML::style('project/resources/assets/plugins/owl.carousel/owl.theme.css') !!}
    {!! HTML::style('project/resources/assets/plugins/owl.carousel/owl.transitions.css') !!}


    @yield('css')
</head>
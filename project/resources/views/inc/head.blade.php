<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    {!! HTML::style('project/resources/assets/css/style.css') !!}
    {!! HTML::style('project/resources/assets/css/bootstrap.min.css') !!}
    {!! HTML::style('project/resources/assets/plugins/notify/css/jquery.ambiance.css') !!}

    @yield('css')
</head>
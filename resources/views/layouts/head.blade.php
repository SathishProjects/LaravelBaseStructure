<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="admin-api-url" data-service="admin" content="{{ url('/api') }}">
    <meta name="base-api-url" content="{{ url('/api') }}">
    <meta name="base-template-url" content="{{url('/')}}">        
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" type="image/png">
    <title>Apptha Admin Panel</title>    
    <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/daterangepicker.css')}}" />
    <link href="{{asset('assets/css/style.default.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/dd.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-wysihtml5.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
</head>
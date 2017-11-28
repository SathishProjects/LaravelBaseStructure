<!DOCTYPE html>
<html lang="en">
 @include('layouts.head')
  <title>Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
 <body>
  <div id="preloader">
   <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
  </div>
  <section class="clearfix">
   @yield('content')
  </section>
  @include('layouts.footer')
  @section('scripts')
  @show
 </body>
</html>
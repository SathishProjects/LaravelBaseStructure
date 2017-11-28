@extends('layouts.login')

@section('content')
<div class="login_header clearfix"> <h1 class="logo"></h1>

<div class="container">
    <div class="row">
        <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> 
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;text-align: center;font-size: 17px;color: #444;padding: 15px 20px;margin: 0;font-weight: bold;"> Admin Login </div>
                <div class="panel-body">
                    <form class="form-horizontal" id="form" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        
                        <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}" >
                         <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                         <input id="email" type="email" class="form-control" placeholder="Username" name="email" value="{{ old('email') }}" required autofocus>
                        </div>
                        @if ($errors->has('email'))
                           <p class="help-block" style="margin-top: -20px;color: #a94442;">{{ $errors->first('email') }}</p>
                         @endif
                        
                        <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                          <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block" style="margin-top: -20px;color: #a94442;">{{ $errors->first('password') }}</span>
                        @endif
<!--                         <div class="form-group"> -->
<!--                             <div class="col-md-6 col-md-offset-4"> -->
<!--                                 <div class="checkbox"> -->
<!--                                     <label> -->
<!--                                         <input type="checkbox" name="remember"> Remember Me -->
<!--                                     </label> -->
<!--                                 </div> -->
<!--                             </div> -->
<!--                         </div> -->
                        
                        <div class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button  class="btn btn-primary pull-right "><i class="glyphicon glyphicon-log-in"></i> Login </button>
                            <a class="btn btn-link" href="{{ url('/password/reset') }}"> 
                                    Forgot Your Password?
                            </a>                          
                        </div>
                    </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

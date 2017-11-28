@extends('layouts.login')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
            <div class="row">                
               <div class="iconmelon">
                  <h1 class="logo"></h1>
               </div>
           </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title text-center">Forget Password</div>
                </div> 
                 
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" id="form" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}
                       <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                            
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            
                        </div>
                        
                        <div class="form-group">
                            <!-- Button -->
                            <div class="col-sm-12 controls">
                            <button  class="btn btn-primary pull-right" type="submit"><i class="glyphicon glyphicon-log-in"></i> Submit </button>                          
                            <a href="{{ url('admin/auth/login') }}" class="pull-left forgot_link">Login</a>
                            </div>
                        </div>
                        
<!--                         <div class="form-group"> -->
<!--                             <div class="col-md-6 col-md-offset-4"> -->
<!--                                 <button type="submit" class="btn btn-primary"> -->
<!--                                     Send Password Reset Link -->
<!--                                 </button> -->
<!--                             </div> -->
<!--                         </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

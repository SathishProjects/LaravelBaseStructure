@extends('layouts.default')
@section('section-heading')
@endsection
@section('content')
<div class="contentpanel">
@include('layouts.errors')
<div class="vertical-tabs clearfix">
<div class="col-md-12">
<!-- Tab panes -->
<div class="tab-content form">
<h4 class="heading col-md-6 nopadding">{{ trans('passwords.change_password') }}</h4>
<form name="" method="post" action="{{url('changepassword')}}" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="row">
<div class="col-sm-9 ">
<div class="form-group">
<div class="col-md-4">
<label class="label_name">	{{trans('passwords.old_password')}}<span class="asterisk">*</span></label>
</div>
<div class="col-md-8">
<input type="password" class="form-control" name="old_password">
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-9 ">
<div class="form-group">
<div class="col-md-4">
<label class="label_name">{{trans('passwords.new_password')}}<span class="asterisk">*</span></label>
</div>
<div class="col-md-8">
<input type="password" class="form-control" name="new_password">
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-9 ">
<div class="form-group">
<div class="col-md-4">
<label class="label_name">{{trans('passwords.confirm_password')}}<span class="asterisk">*</span></label>
</div>
<div class="col-md-8">
<input type="password" class="form-control" name="confirm_password">
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-9 ">
<div class="form-group">
<div class="col-md-4">
</div>
<div class="col-md-8">
<input type="submit" class="btn blue-button" value="Submit"/>
<a class="btn-default btn" href="{{url('dashboard')}}">{{ trans('general.cancel') }}</a>
</div>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
@endsection
@section('scripts')
 <script type="text/javascript" src="{{asset('assets/js/lib/jquery.dd.js')}}"></script>    
    <script src="{{asset('assets/js/modules/base/requestFactory.js')}}"></script>
    <script src="{{asset('assets/js/modules/base/notificationDirective.js')}}"></script>
@endsection
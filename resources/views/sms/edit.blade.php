@extends('layouts.default')
@section('content')
@section('section-heading')
 {{ trans('sms.edit_sms_template') }}
@endsection
<div class="contentpanel">
    <div class="content-header clearfix">
      <h2>Edit Sms Template</h2>
   </div>
    @include('layouts.errors')
    <div class="content clearfix" data-ng-controller="SmsController as smsCtrl" data-ng-init="smsCtrl.fetchSingleInfo({{$id}})" >
            <form method="post" data-base-validator data-ng-submit = "smsCtrl.save($event)" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-page-bg">
            <div class="form-page clearfix">
                <div class="col-md-12">
                <div class="form-group" data-ng-class="{'has-error': errors.name.has}">
                        <div class="col-md-2">
                            <label class="label-name">{{ trans('sms.name') }}<span class="asterisk">*</span></label>
                        </div>
                        <div class="col-md-6">
                            <input class="form-control"  name="name" data-ng-model="smsCtrl.sms.name" />
                            <p class="help-block" data-ng-show="errors.name.has">@{{ errors.name.message }}</p>
                        </div>
                    </div>
                    <div class="form-group" data-ng-class="{'has-error': errors.subject.has}">
                        <div class="col-md-2">
                            <label class="label-name">{{ trans('sms.subject') }}<span class="asterisk">*</span></label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="subject" data-ng-model='smsCtrl.sms.subject'>
                            <p class="help-block" data-ng-show="errors.subject.has">@{{ errors.subject.message }}</p>
                        </div>
                    </div>
                    <div class="form-group" data-ng-class="{'has-error': errors.content.has}">
                        <div class="col-md-2">
                            <label class="label-name">{{ trans('sms.content') }}</label>
                        </div>
                        <div class="col-md-10">
                            <textarea id="wysiwyg" rows="14" name="content" class="form-control" data-ng-model="smsCtrl.sms.content"></textarea>
                            <p class="help-block" data-ng-show="errors.content.has">@{{ errors.content.message }}</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="form-page clearfix">
                      <div class="col-md-8">
                          <div class="col-md-4">
                          </div>
                          <div class="col-md-8">
                              <input type="submit" class="btn blue-button" value="Submit"/>
                              <a href="{{url('sms')}}" class="btn-default btn">{{ trans('general.cancel') }}</a>
                          </div>
                      </div>
                  </div>
            </form>
        </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('assets/js/lib/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('assets/js/lib/tinymce/tinymce-config.js')}}"></script>
<script src="{{asset('assets/js/modules/base/requestFactory.js')}}"></script> 
<script src="{{asset('assets/js/modules/base/Validate.js')}}"></script>
<script src="{{asset('assets/js/modules/base/validatorDirective.js')}}"></script>
<script src="{{asset('assets/js/modules/base/notificationDirective.js')}}"></script>
<script src="{{asset('assets/js/modules/sms/app.js')}}"></script>
<script src="{{asset('assets/js/lib/wysihtml5-0.3.0.min.js')}}"></script>
<script src="{{asset('assets/js/lib/bootstrap-wysihtml5.js')}}"></script>
@endsection
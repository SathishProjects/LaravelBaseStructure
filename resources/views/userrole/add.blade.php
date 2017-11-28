@extends('layouts.default')
@section('content')
@section('section-heading')
 {{ trans('user.add_roles') }}
@endsection
    <div class="contentpanel">
    @include('layouts.errors')
        <div class="content-header clearfix">
                <h2>{{ trans('user.add_roles') }}</h2>
            </div>
        <div class="content clearfix" data-ng-controller="RoleController as roleCtrl" data-ng-init="roleCtrl.fetchInfo()">
            <div class="form-page clearfix">
            <form name="roleForm" data-base-validator data-ng-submit="roleCtrl.save($event)">
                <div class="col-md-6">
                   <div class="form-group" data-ng-class="{'has-error': errors.name.has}" >
                        <div class="col-md-4">
                            <label class="label-name">Role Name<span class="asterisk">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <input data-ng-model="roleCtrl.userRole.name" type="text" class="form-control" name="name">
                            <p class="help-block" data-ng-show="errors.name.has">@{{ errors.name.message }}</p>
                        </div>
                    </div>
                    
                     <div class="form-group" data-ng-class="{'has-error': errors.permissions.has}">
                        <div class="col-md-4">
                            <label class="label-name">User Permissions<span class="asterisk">*</span></label>
                        </div>
                       <div class="col-md-8">                        
                       <multiselect ng-model="roleCtrl.userRole.permissions" name="permissions" options="options" show-select-all="true" show-unselect-all="true"></multiselect>
                       <p class="help-block" data-ng-show="errors.permissions.has">@{{ errors.name.message }}</p>
                       <p class="help-block" style="color: #a94442" data-ng-show="roleCtrl.permissionsMsg">The User permission is required.</p>
                       </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-4">
                            <label>Status<span class="asterisk">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <div class="col-md-6 nopadding">
                                <div class="rdio rdio-primary">
                                  <input data-ng-model="roleCtrl.userRole.is_active" type="radio" id="active" data-ng-value="1" name="is_active">                                
                                    <label for="active">{{trans('general.active')}}</label>
                                </div>
                            </div>
                            <div class="col-md-6 nopadding">
                                <div class="rdio rdio-primary">
                                  <input data-ng-model="roleCtrl.userRole.is_active" type="radio" id="inactive" data-ng-value="0" name="is_active">
                                  <label for="inactive">{{trans('general.inactive')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-8">
                            <button type="submit" class="btn blue-button">Submit</button>
                            <a href="{{url('userrole')}}" class="btn-default btn">Cancel</a>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>    
@endsection
@section('scripts')
<script src="{{asset('assets/js/lib/angular-bootstrap-multiselect.min.js')}}"></script>
<script src="{{asset('assets/js/modules/base/requestFactory.js')}}"></script>
<script src="{{asset('assets/js/modules/base/Validate.js')}}"></script>
<script src="{{asset('assets/js/modules/base/validatorDirective.js')}}"></script>
<script src="{{asset('assets/js/modules/base/validatorDirective.js')}}"></script>
<script src="{{asset('assets/js/modules/base/notificationDirective.js')}}"></script>
<script src="{{asset('assets/js/modules/userrole/app.js')}}"></script>
@endsection
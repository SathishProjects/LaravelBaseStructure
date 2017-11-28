@extends('layouts.default')
@section('content')
@section('section-heading')
{{ trans('user.add_admin') }}
@endsection
<div class="contentpanel">
   <div class="content-header clearfix">
      <h2>{{ trans('user.add_admin') }}</h2>
   </div>
   @include('layouts.errors')
   <div class="content clearfix" data-ng-controller="AdminUserController as adminUserCtrl" data-ng-init = "adminUserCtrl.fetchAddformRules()">
      <form method="post" data-base-validator data-ng-submit = "adminUserCtrl.save($event)" enctype="multipart/form-data">
         {{ csrf_field() }}
         <div class="form-page-bg add-customer">
            <div class="form-page  clearfix">
               <div class="col-md-7 left-details">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group" data-ng-class="{'has-error': errors.name.has}">
                           <div class="col-md-12">
                              <label class="label-name">{{ trans('general.name') }}<span class="asterisk">*</span></label>
                           </div>
                           <div class="col-md-12">
                              <input type="text" class="form-control" data-ng-model='adminUserCtrl.adminUser.name' name="name">
                              <p class="help-block" data-ng-show="errors.name.has">@{{ errors.name.message }}</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group" data-ng-class="{'has-error': errors.email.has}">
                           <div class="col-md-12">
                              <label class="label-name">{{ trans('general.email') }}<span class="asterisk">*</span></label>
                           </div>
                           <div class="col-md-12">
                              <input type="email" class="form-control" data-ng-model='adminUserCtrl.adminUser.email' name="email">
                              <p class="help-block" data-ng-show="errors.email.has">@{{ errors.email.message }}</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group" data-ng-class="{'has-error': errors.mobile_number.has}">
                           <div class="col-md-12">
                              <label class="label-name">{{ trans('general.contact_number') }}<span class="asterisk">*</span></label>
                           </div>
                           <div class="col-md-12">
                              <input type="text" class="form-control" name="mobile_number" data-ng-model='adminUserCtrl.adminUser.mobile_number'>
                              <p class="help-block" data-ng-show="errors.mobile_number.has">@{{ errors.mobile_number.message }}</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group" >
                           <div class="col-md-12">
                              <label>{{ trans('general.gender') }}<span class="asterisk">*</span></label>
                           </div>
                           <div class="col-md-12">
                              <div class="col-md-6 nopadding">
                                 <div class="rdio rdio-primary">
                                    <input type="radio" id="Male" value="male" name="gender" data-ng-model='adminUserCtrl.adminUser.gender'>                                
                                    <label for="Male">{{ trans('general.male') }}</label>
                                 </div>
                              </div>
                              <div class="col-md-6 nopadding">
                                 <div class="rdio rdio-primary">
                                    <input type="radio" id="Female" value="female" name="gender" data-ng-model='adminUserCtrl.adminUser.gender'>
                                    <label for="Female">{{ trans('general.female') }}</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group" data-ng-class="{'has-error': errors.company.has}">
                           <div class="col-md-12">
                              <label class="label-name">{{ trans('user.thead.company') }}<span class="asterisk">*</span></label>
                           </div>
                           <div class="col-md-12" >
                              <select class="form-control" name="company"
                                 data-ng-model="adminUserCtrl.adminUser.company" data-ng-init="adminUserCtrl.adminUser.company=''" >
                                 <option value=''>Select</option>
                                 <option data-ng-value='Moverbee'>Moverbee</option>
                              </select>
                              <p class="help-block" data-ng-show="errors.company.has">@{{ errors.company.message }}</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group" data-ng-class="{'has-error': errors.user_role.has}">
                           <div class="col-md-12">
                              <label class="label-name">{{ trans('user.role') }}<span class="asterisk">*</span></label>
                           </div>
                           <div class="col-md-12">
                              <select class="form-control"  name="user_role"
                                 data-ng-model="adminUserCtrl.adminUser.user_role" 
                                 data-ng-options="role.id as role.name for role in adminUserCtrl.roles">
                                 <option  value="">Select</option>
                              </select>
                              <p class="help-block" data-ng-show="errors.user_role.has">@{{ errors.user_role.message }}</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group" data-ng-class="{'has-error': errors.address.has}">
                           <div class="col-md-12">
                              <label class="label-name">{{ trans('general.address') }}<span class="asterisk">*</span></label>
                           </div>
                           <div class="col-md-12">
                              <input data-ng-model='adminUserCtrl.adminUser.address' name="address" type="text" class="form-control" placeholder="Enter address line (Flat/House no, floor, building)">
                              <p class="help-block" data-ng-show="errors.address.has">@{{ errors.address.message }}</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group" data-ng-class="{'has-error': errors.city.has}">
                           <div class="col-md-12">
                              <label class="label-name">{{ trans('general.city') }}<span class="asterisk">*</span></label>
                           </div>
                           <div class="col-md-12">
                              <select class="form-control"  name="city"
                                 data-ng-model="adminUserCtrl.adminUser.city" 
                                 data-ng-options="city.id as city.name for city in adminUserCtrl.cities">
                                 <option  value="">Select</option>
                              </select>
                              <p class="help-block" data-ng-show="errors.city.has">@{{ errors.city.message }}</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group" data-ng-class="{'has-error': errors.zipcode.has}">
                           <div class="col-md-12">
                              <label class="label-name">{{ trans('general.zipcode') }}<span class="asterisk">*</span></label>
                           </div>
                           <div class="col-md-12">
                              <input type="text" class="form-control" name="zipcode" data-ng-model='adminUserCtrl.adminUser.zipcode'>
                              <p class="help-block" data-ng-show="errors.zipcode.has">@{{ errors.zipcode.message }}</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group" data-ng-class="{'has-error': errors.state.has}">
                           <div class="col-md-12">
                              <label class="label-name">{{ trans('general.state') }}<span class="asterisk">*</span></label>
                           </div>
                           <div class="col-md-12">
                              <select class="form-control"  name="state"
                                 data-ng-model="adminUserCtrl.adminUser.state" 
                                 data-ng-options="state.id as state.name for state in adminUserCtrl.states">
                                 <option  value="">Select</option>
                              </select>
                              <p class="help-block" data-ng-show="errors.state.has">@{{ errors.state.message }}</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group" data-ng-class="{'has-error': errors.country.has}">
                           <div class="col-md-12">
                              <label class="label-name">{{ trans('general.country') }}<span class="asterisk">*</span></label>
                           </div>
                           <div class="col-md-12">
                              <select class="form-control"  name="country"
                                 data-ng-model="adminUserCtrl.adminUser.country" 
                                 data-ng-options="country.id as country.name for country in adminUserCtrl.countries">
                                 <option  value="">{{trans('general.select')}}</option>
                              </select>
                              <p class="help-block" data-ng-show="errors.country.has">@{{ errors.country.message }}</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-5 right-details">
                  <div class="form-group">
                     <div class="col-md-12 user-image">
                        <input type="file" id="picture-user" style="visibility:hidden" class="form-control" data-ng-model="adminUserCtrl.adminUser.uploadedImage" >   
                        <div class="clsFileUpload image-upload">
                            <div id="user-progress" class="hide clsProgressbar"></div>
                        </div>   
                        <div id="user-profile-image"  class="profile-image">
                           <label class="profile-default" for="logo" >
                           <img src="{{asset('assets/images/default-user.png')}}"> 
                           </label>
                        </div>
                        
                        <label class="overlay profile-default" data-ng-click="adminUserCtrl.triggerSelectFile('#picture-user')" >
                        <img src="{{asset('assets/images/camera.png')}}"> {{trans('general.upload')}}
                       </label>
                       <p class="text-right datas_image mb5 col-md-11">{{trans('settings.image_size')}}</p>
                       <p class="text-right datas_image mb5 col-md-11">{{trans('settings.image_format')}}</p>  
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-md-4">
                        <label>{{ trans('general.status') }}<span class="asterisk">*</span></label>
                     </div>
                     <div class="col-md-8">
                        <div class="col-md-4 nopadding">
                           <div class="rdio rdio-primary">
                              <input type="radio" id="acive-freelancer" data-ng-value="1" name="is_active" data-ng-model='adminUserCtrl.adminUser.is_active'>                                
                              <label for="acive-freelancer">{{ trans('general.active') }}</label>
                           </div>
                        </div>
                        <div class="col-md-6 nopadding">
                           <div class="rdio rdio-primary">
                              <input type="radio" id="inactive-freelancer" data-ng-value="0" name="is_active" data-ng-model='adminUserCtrl.adminUser.is_active'>
                              <label for="inactive-freelancer">{{ trans('general.inactive') }}</label>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="form-page clearfix">
            <div class="col-md-12 text-center">
               <input type="submit" class="btn blue-button" value="Submit"/>
               <a href="{{url('admin')}}" class="btn-default btn">{{ trans('general.cancel') }}</a>
            </div>
         </div>
      </form>
   </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('assets/js/modules/base/requestFactory.js')}}"></script> 
<script src="{{asset('assets/js/modules/base/Validate.js')}}"></script>
<script src="{{asset('assets/js/modules/base/validatorDirective.js')}}"></script>
<script src="{{asset('assets/js/modules/base/notificationDirective.js')}}"></script>
<script src="{{asset('assets/js/modules/base/Uploader.js')}}"></script>
<script src="{{asset('assets/js/modules/adminuser/app.js')}}"></script>
@endsection
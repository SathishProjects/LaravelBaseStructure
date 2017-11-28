@extends('layouts.default')
@section('section-heading')
 Settings
@endsection
@section('content')
<div class="contentpanel">
   <div class="upper-content clearfix">
      <div class="col-md-6">
         <ul class="breadcrumb">
            <li><a href="index.php">{{ trans('general.dashboard') }}</a></li>
            <li>Settings</li>
         </ul>
      </div>
   </div>
    @include('layouts.errors')
   <div class="vertical-tabs clearfix">
      <div class="col-md-12">
         <!-- Tab panes -->
         <div class="tab-content form">
            @foreach($settingsField as $key => $settingsData )
                <h4 class="heading col-md-6 nopadding">{{$settingsData->name}}</h4>
                <form name="{{$settingsData->slug}}" method="post" action="{{URL('settings/update')}}" enctype="multipart/form-data">
                 {{ csrf_field() }}
                 @foreach($settingsData['settings'] as $key => $fields)
                   @if($fields->is_active !=0)
                     <div class="row">
                        <div class="col-sm-9 ">
                             <div class="form-group">
                                <div class="col-md-4">
                                   <label class="label_name">{{$fields->display_name}}<span class="asterisk">*</span></label>
                                </div>
                                <div class="col-md-8">
                                   @if($fields->type == 'text')
                                    <input name="{{$settingsData->slug.'__'.$fields->setting_name}}" class="form-control" id="{{$fields->setting_name}}" value="{{old($fields->setting_name, $fields->setting_value)}}">
                                   @elseif($fields->type == 'image')
                                     <input name="{{$settingsData->slug.'__'.$fields->setting_name}}" id="{{$fields->setting_name}}" type="file" class="form-control hidden">
                                     <label class="file" for="{{$fields->setting_name}}">Upload</label>
                                     <img src="{{asset('assets/images/'.$fields->setting_value)}}" class="image-preview">
                                    @if($fields->description)
                                     <p class="help-block">{{$fields->description}}</p>
                                    @endif
                                   @elseif($fields->type == 'dropdown')
                                    <select name="{{$settingsData->slug.'__'.$fields->setting_name}}" id="{{$fields->setting_name}}" class="form-control select">
                                    <option disabled>Select</option>
                                   @foreach($fields->getOption() as $value)    
                                      <option @if($fields->setting_value == $value) selected="selected" @endif value="{{ $value }}">{{ $value }}</option>
                                   @endforeach
                                    </select>
                                   @elseif($fields->type == 'radio')
                                   @foreach($fields->getOption() as $value)
                                     <div class="col-md-6 nopadding">
                                        <div class="rdio rdio-primary">
                                           <input @if($fields->setting_value == $value) checked="checked" @endif name="{{$settingsData->slug.'__'.$fields->setting_name}}" value="{{$value}}" type="radio" id="{{$fields->setting_name}}-{{$value}}">
                                           <label for="{{$fields->setting_name}}-{{$value}}">{{ucfirst($value)}}</label>
                                        </div>
                                     </div>
                                   @endforeach
                                   @endif
                                   
                                </div>
                             </div>
                        </div>
                     </div>
                   @endif
                 @endforeach
            @endforeach
                <div class="row">
                  <div class="col-sm-9 ">
                     <div class="form-group">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-8">
                           <input type="submit" class="btn blue-button" value="Submit"/>
                           <a class="btn-default btn" href="{{url('settings')}}">{{ trans('general.cancel') }}</a>
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
<script src="{{asset('assets/js/modules/base/notificationDirective.js')}}"></script>
@endsection
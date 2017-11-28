@extends('layouts.default')

@section('content')
    <div class="contentpanel">
        <div class="content clearfix">
            <div data-grid-view 
                 data-rows-per-page="10"
                 data-module-name="admin"
            ></div>        
        </div>
    </div>        
@endsection

@section('scripts')    
    <script type="text/javascript" src="{{asset('assets/js/lib/jquery.dd.js')}}"></script>    
    <script src="{{asset('assets/js/modules/base/requestFactory.js')}}"></script>
    <script src="{{asset('assets/js/modules/base/notificationDirective.js')}}"></script>
    <script src="{{asset('assets/js/modules/base/gridView.js')}}"></script>
    <script src="{{asset('assets/js/modules/base/grid.js')}}"></script>
@endsection
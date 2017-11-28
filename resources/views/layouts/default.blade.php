<!DOCTYPE>
<html>
   @include('layouts.head')
    <body>
	<!-- Preloader -->
	<div id="preloader">
		<div id="status">
			<i class="fa fa-spinner fa-spin"></i>
		</div>
	</div>

	<section>
            @include('layouts.sidebar')
            <div class="mainpanel">
                @include('layouts.containerhead')                
                @include('layouts.notifications')
                @yield('content')
            </div>          
        </section>
        @include('layouts.footer')       
        @section('scripts')
        @show
        
    </body>
</html>
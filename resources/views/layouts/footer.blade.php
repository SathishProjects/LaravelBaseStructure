<script type="text/javascript" src="{{asset('assets/js/lib/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/lib/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/lib/tablesaw-init.js')}}"></script>    
<script type="text/javascript" src="{{asset('assets/js/lib/tablesaw.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/lib/angular.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/lib/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/lib/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/lib/bootstrap-datetimepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/lib/bootstrap-wizard.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/modules/custom.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/lib/angular-ui-router.js')}}"></script>
<script type="text/javascript">
$(document).on("mouseover", function() {
                var mainheight = $('.mainpanel').height();
                var headerheight = $('.headerbar').height();
                var  totalheight= mainheight + headerheight;
                $('.leftpanel').css('min-height',totalheight);
            });
$(document).ready(function() {
    var headerheight = $('.headerbar').height();
    var windowheight=$("#map").height();
    $('#map').css('height',windowheight - headerheight);
});
</script>

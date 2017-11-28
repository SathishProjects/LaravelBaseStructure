<!-- headerbar -->
<div class="headerbar">
   <a class="menutoggle"><i class="fa fa-bars"></i></a>
   <h1 class="logo"></h1>
   <h2 class="heading">@yield('section-heading')</h2>
   <!-- header-right -->
   <div class="header-right">
      <div class="right-side">
         <div class="hexagon">
            <i class="icon-notification"></i> <span class="count">4</span>
         </div>
         <ul class="headermenu">
            <li>
               <div class="btn-group">
                  <div class="hexagon-image hexagon2 dropdown-toggle "
                     data-toggle="dropdown">
                     <div class="hexagon-in1">
                        <div class="hexagon-in2" style="background:">A</div>
                     </div>
                  </div>
                  <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                     <li><a href="#"><i class="glyphicon glyphicon-user"></i>{{trans('contentheader.adminheader.my-profile')}}</a></li>
                     <li><a href="{{url('changepassword')}}"><i
                        class="glyphicon glyphicon-cog"></i>{{trans('sidebar.adminsidebar.changePassword')}}</a></li>
                     <li>
                     <form method="post" action="{{url('logout')}}" >
                     {{ csrf_field() }}
                     <button><i class="glyphicon glyphicon-log-out"></i>{{trans('sidebar.adminsidebar.logOut')}}</button>
                     </form>
                     </li>
                  </ul>
               </div>
            </li>
         </ul>
      </div>
   </div>
   <!-- header-right -->
</div>
<!-- headerbar -->
<div class="leftpanel">
   <div class="slim">
      <div class="leftpanelinner">
         <!-- This is only visible to small devices -->
         <div class="visible-xs hidden-sm hidden-md hidden-lg">
            <div class="media userlogged">
               <div class="media-body">
                  <h4>John Doe</h4>
                  <span>"Life is so..."</span>
               </div>
            </div>
            <h5 class="sidebartitle actitle">{{trans('sidebar.adminsidebar.account')}}</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
               <li><a href="profile.html"><i class="fa fa-user"></i> <span>{{trans('sidebar.adminsidebar.profile')}}</span></a></li>
               <li><a href="#"><i class="fa fa-cog"></i> <span>{{trans('sidebar.adminsidebar.changePassword')}}</span></a></li>
               <li><a href="signout.html"><i class="fa fa-sign-out"></i> <span>{{trans('sidebar.adminsidebar.logOut')}}</span></a></li>
            </ul>
         </div>
         <ul class="nav nav-pills nav-stacked nav-bracket navigation">
            <li class="{{$isRouteActive('dashboard')}}">
               <a href="{{url('dashboard')}}">                
               <i class="icon-overview"></i>
               <span>Overview</span>
               </a>
            </li>
            
            <li class="nav-parent {{$isRouteActive(['admin','userrole'])}}">
               <a href="#">                
               <i class="icon-manage-admin"></i>
               <span>Manage Admin</span>                        
               <i class="icon-dropdown-menu"></i>
               </a>
               <ul class="children" style="{{$isRouteActive(['admin','userrole']) == 'nav-active' ? 'display:block' : 'display:none'}}">
                  <li class="{{$isRouteActive('admin')}}">
                     <a href="{{url('admin')}}">
                     <i class="fa fa-caret-right"></i>
                     Admin Users
                     </a>
                  </li>
                  <li class="{{$isRouteActive('userrole')}}">
                     <a href="{{url('userrole')}}">
                     <i class="fa fa-caret-right"></i>
                     Admin User roles
                     </a>
                  </li>
               </ul>
            </li>
            
            <li>
               <a href="#">                
               <i class="icon-manage-cms"></i>
               <span>Manage CMS</span>
               </a>
            </li>
            <li class="nav-parent {{$isRouteActive(['email','sms'])}}" >
               <a href="#">                
               <i class="icon-manage-template"></i>
               <span>Manage Templates</span>
               <i class="icon-dropdown-menu"></i>
               </a>
               <ul class="children" style="{{$isRouteActive(['email','sms','pushnotification']) == 'nav-active' ? 'display:block' : 'display:none'}}">
                  <li class="{{$isRouteActive('email')}}">
                     <a href="{{url('email')}}">
                     <i class="fa fa-caret-right"></i>
                     Email Template
                     </a>
                  </li>
                  <li class="{{$isRouteActive('sms')}}">
                     <a href="{{url('sms')}}">
                     <i class="fa fa-caret-right"></i>
                     SMS Template
                     </a>
                  </li>
                   <li class="{{$isRouteActive('pushnotification')}}">
                     <a href="{{url('pushnotification')}}">
                     <i class="fa fa-caret-right"></i>
                     Push Notification
                     </a>
                  </li>
               </ul>
            </li>
            
            
           
            <li class="{{$isRouteActive('settings')}}">
               <a href="{{url('settings')}}">                
               <i class="icon-settings"></i>
               <span>Settings</span>
               </a>
            </li>
            
            <li class="nav-parent">
               <a href="#">                
               <i class="icon-report"></i>
               <span>Reports</span>
               <i class="icon-dropdown-menu"></i>
               </a>
            </li>
         </ul>
      </div>
      <!-- leftpanelinner -->
   </div>
</div>
<!-- leftpanel -->
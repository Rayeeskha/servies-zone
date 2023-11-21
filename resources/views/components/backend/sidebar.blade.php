@php 
   $role_id = Auth::user()->role_id;
   $allPermission = false;
   if(!empty($role_id) && $role_id == '1'){
      $allPermission = true;
   }
   $group = CustomHelper::getUserRolePermission();
@endphp

<div class="sidebar" id="sidebar">
   <div class="sidebar-inner slimscroll">
      <div id="sidebar-menu" class="sidebar-menu">
         <ul>
            <li class="{{ (in_array(Route::currentRouteName(),['admin.dashboard']) ? 'active' :'')}}">
               <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('backend/assets/img/icons/dashboard.svg') }}" alt="img"><span> Dashboard</span> </a>
            </li>
            
            {{--@if($allPermission || ((array_search('Customers', array_column($group, 'module_id'))) !== false ))
            <li class="submenu">
               <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/users1.svg') }}" alt="img"><span> Customers</span> <span class="menu-arrow"></span></a>
               <ul>
                  <li><a href="#!">Manage Customer</a></li>
               </ul>
            </li>
            @endif --}}

            @if($allPermission || ((array_search('Electrician', array_column($group, 'module_id'))) !== false ))
            <li class="submenu {{ (in_array(Route::currentRouteName(),['admin.electrician.index']) ? 'active' :'')}}">
               <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/quotation1.svg') }}" alt="img"><span> Electrician</span> <span class="menu-arrow"></span></a>
               <ul>
                  <li><a href="{{ route('admin.electrician.index') }}">Manage Electrician</a></li>
               </ul>
            </li>
            @endif

            @if($allPermission || ((array_search('Employee', array_column($group, 'module_id'))) !== false ))
            <li class="submenu {{ (in_array(Route::currentRouteName(),['admin.employee.index']) ? 'active' :'')}}">
               <a href="javascript:void(0)"><img src="{{ asset('backend/assets/img/icons/product.svg') }}" alt="img"><span> Employees</span> <span class="menu-arrow"></span></a>
               <ul>
                  <li><a href="{{ route('admin.employee.index') }}">Manage Employees</a></li>
               </ul>
            </li>
            @endif

            @if($allPermission || ((array_search('Leads', array_column($group, 'module_id'))) !== false ))
            <li class="submenu {{ (in_array(Route::currentRouteName(),['admin.lead-inquiry.index']) ? 'active' :'')}}">
               <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/return1.svg') }}" alt="img"><span> Leads</span> <span class="menu-arrow"></span></a>
               <ul>
                  <li><a href="{{ route('admin.lead-inquiry.index') }}">Manage Leads</a></li>
               </ul>
            </li>
            @endif

            @if($allPermission || ((array_search('ServiceActivation', array_column($group, 'module_id'))) !== false ))
            <li class="submenu {{ (in_array(Route::currentRouteName(),['admin.service-activation.index']) ? 'active' :'')}}">
               <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/transfer1.svg') }}" alt="img"><span> Service activation</span> <span class="menu-arrow"></span></a>
               <ul>
                  <li><a href="{{ route('admin.service-activation.index') }}">Service activation</a></li>
               </ul>
            </li>
            @endif

            @if($allPermission || ((array_search('PaymentDetails', array_column($group, 'module_id'))) !== false ))
            <li class="submenu">
               <a href="javascript:void(0);"><img src="{{ asset('backend/assets/img/icons/purchase1.svg') }}" alt="img"><span> Payment details</span> <span class="menu-arrow"></span></a>
               <ul>
                  <li><a href="{{ route('admin.payment-details.index') }}">Payment details</a></li>
               </ul>
            </li>
            @endif

            {{--@if($allPermission || ((array_search('contactus', array_column($group, 'module_id'))) !== false ))
            <li class="submenu {{ (in_array(Route::currentRouteName(),['admin.contact-us.index']) ? 'active' :'')}}">
               <a href="javascript:void(0)"><img src="{{ asset('backend/assets/img/icons/settings.svg') }}" alt="img"><span> Contact us</span> <span class="menu-arrow"></span></a>
               <ul>
                  <li><a href="{{ route('admin.contact-us.index') }}">Contact us</a></li>
               </ul>
            </li>
            @endif --}}

            @if($allPermission || ((array_search('RolePermission', array_column($group, 'module_id'))) !== false ))
            <li class="submenu {{ (in_array(Route::currentRouteName(),['admin.role-master.index']) ? 'active' :'')}}">
               <a href="javascript:void(0)"><img src="{{ asset('backend/assets/img/icons/settings.svg') }}" alt="img"><span> Role and Permission</span> <span class="menu-arrow"></span></a>
               <ul>
                  <li><a href="{{ route('admin.role-master.index') }}">Manage Role & Permission</a></li>
               </ul>
            </li>
            @endif

            @if($allPermission || ((array_search('loginHistory', array_column($group, 'module_id'))) !== false ))
            <li class="submenu {{ (in_array(Route::currentRouteName(),['admin.login-log.index']) ? 'active' :'')}}">
               <a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg><span> Login History</span> <span class="menu-arrow"></span></a>
               <ul>
                  <li><a href="{{ route('admin.login-log.index') }}">Login History</a></li>
               </ul>
            </li>
            @endif
         </ul>
      </div>
   </div>
</div>
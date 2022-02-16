<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('vehicledetail') }}'><i class='nav-icon la la-list-alt'></i> {{ trans('vehicleDetail.title_text') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('vehicletype') }}'><i class='nav-icon la la-bus'></i> {{ trans('vehicleType.title_text') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('employee') }}'><i class='nav-icon la la-users'></i> {{ trans('employee.title_text') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>


<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-gear"></i> Master Data</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('gender') }}'><i class='nav-icon la la-intersex '></i> {{ trans('gender.title_text') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('employeetype') }}'><i class='nav-icon la la-user'></i> {{ trans('employeeType.title_text') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('vehicle') }}'><i class='nav-icon la la-car'></i> {{ trans('vehicle.title_text') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('bookingpolicy') }}'><i class='nav-icon la la-check-square-o'></i> {{ trans('bookingPolicy.title_text') }} </a></li>
    </ul>
</li>

@if(backpack_user()->hasRole('superadmin'))
    <!-- Users, Roles, Permissions -->
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-gear"></i> Application</a>
        <ul class="nav-dropdown-items">
            <li class='nav-item'><a class='nav-link' href="{{ backpack_url('client') }}"><i class='nav-icon la la-group'></i> Clients</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
            <!-- <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li> -->
        </ul>
    </li>
@endif
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{url('dashboard')}}" class="nav-link @if(session('page') == 'dashboard') active @endif">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>

        </li>
        <li class="nav-item">
            <a href="{{url('user')}}" class="nav-link @if(session('page') == 'user') active @endif">
                <i class="fas fa-users nav-icon"></i>
                <p>Users</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('application')}}" class="nav-link @if(session('page') == 'application') active @endif">
                <i class="fas fa-address-card nav-icon"></i>
                <p>Application</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('form')}}" class="nav-link @if(session('page') == 'form') active @endif">
                <i class="fas fa-align-center nav-icon"></i>
                <p>Forms</p>
            </a>
        </li>
      {{--  <li class="nav-item">
            <a href="{{url('type')}}" class="nav-link @if(session('page') == 'type') active @endif">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Types</p>
            </a>
        </li>--}}
    </ul>
</nav>

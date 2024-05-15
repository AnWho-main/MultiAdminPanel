<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    
      <img src="{{ URL::asset('dist/img/logo_head.png') }}" alt="Logo" class="brand-image elevation-3" style="margin-top:2px" width= "248px;">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          @if(auth()->user()->hasPermission('manage_dashboard'))
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          @endif
  
          
            
         
            @if(auth()->user()->hasPermission('manage_users'))
              <li class="nav-item {{ request()->is('admin_user') || request()->is('admin_user/*') || request()->is('role') || request()->is('role/*') || request()->is('permission') || request()->is('permission_role') || request()->is('permission/*') || request()->is('permission_role/*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('admin_user') || request()->is('admin_user/*') ||  request()->is('role') || request()->is('role/*') || request()->is('permission') || request()->is('permission_role') || request()->is('permission/*') || request()->is('permission_role/*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>
                    Administration
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin_user.index') }}" class="nav-link {{ request()->is('admin_user') || request()->is('admin_user/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Admin Users</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ route('role.index') }}" class="nav-link {{ request()->is('role') || request()->is('role/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Role</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ route('permission.index') }}" class="nav-link {{ request()->is('permission') || request()->is('permission/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Permission</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ route('permission_role.index') }}" class="nav-link {{ request()->is('permission_role') || request()->is('permission_role/*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Role Permission</p>
                    </a>
                  </li>
                  
                </ul>
              </li>
            @endif

            
         
            
          
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<aside id="mainSidebar" class="main-sidebar sidebar-dark-primary elevation-4"
    style="background: linear-gradient(to left, #16416c 5%, #092038 95%);">
    <a href="/" class="brand-link">
        <img src="{{ asset('public/upload/collegelogo.jpeg') }}" alt="Saadat College Logo"
            class="brand-image img-circle elevation-3" style="opacity: .9">
        <span class="brand-text font-weight-light">Saadat College</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('public/upload/admin.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ URL::to('redirect') }}"
                        class="nav-link {{ request()->is('redirect') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL('sportsteacherlist') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Teacher List
                        </p>
                    </a>
                </li>
               
                <li class="nav-item">
                    <a href="{{ URL::to('schampionslist') }}" class="nav-link">
                      <i class="nav-icon fas fa-solid fa-file"></i>
                        <p>
                            Champions list
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('snoticelist') }}" class="nav-link">
                      <i class="nav-icon fas fa-solid fa-file"></i>
                        <p>
                           Notice Board
                        </p>
                    </a>
                </li>
              
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
            <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Sign Out" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        
        </div>
        <!-- /menu footer buttons -->
    </div>
    <!-- /.sidebar -->
</aside>


{{-- <ul class="nav child_menu"> --}}
    {{-- <li><a href="{{ URL('coteacherlist') }}">Teacher List</a></li>
    <li><a href="{{ URL::to('cogallary') }}">Photo Gallary </a></li>
    <li><a href="{{ URL::to('cocurricularnotice') }}">Notice Board</a></li> --}}
    {{-- <li><a href="{{ URL::to('cocurricularmanage') }}">Co_curricular Manage</a></li> --}}
    {{-- <li><a href="{{ URL('covideo') }}">Video Clip</a></li> --}}

{{-- </ul> --}}
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
                    <a href="{{ URL::to('cocurricularmanage') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-user"></i>
                        <p>
                            Co_curricular Manage
                        </p>
                    </a>
                </li>
           </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>

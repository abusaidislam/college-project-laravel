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
                    <a href="{{ URL::to('superadmin') }}"
                        class="nav-link {{ request()->is('redirect') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('usermanage') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('faculty') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Faculty Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('department-entry') }}" class="nav-link">
                        <i class="nav-icon fas fa-house-user"></i>
                        <p>
                            Department Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('menumanage') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-bars"></i>
                        <p>
                            Menu Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('submenumanage') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-bars"></i>
                        <p>
                            Submenu Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('subofsubmenu') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-bars"></i>
                       
                        <p>
                            Sub of Submenu Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('news') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-newspaper"></i>
                        <p>
                            News Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('slideshow') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-newspaper"></i>
                        <p>
                            Slide Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('events') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Events Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('formsmanage') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Forms Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('goldenJubileemanage') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Golden Jubile Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('bangabandhumanage') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Liberation War Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('online_portals') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Online Portals Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('qucklinks') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-link"></i>
                        <p>
                            Quck links Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('basicinfo') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Basic info Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('video_clips') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-video"></i>
                        <p>
                            Video Clips Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('complaincornar') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-newspaper"></i>
                        <p>
                            Complain Corner Message
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-newspaper"></i>
                        <p>
                            Publications Manage
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('journal-of-saadat') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Journal Of Saadat College</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('college-magazine') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>College Magazine</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('other-publication') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Other Publication</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-link"></i>
                        <p>
                            APA Links Manage
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('apalinks') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Links Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('apa-notice') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Notice Magazine</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-link"></i>
                        <p>
                            NIS Links Manage
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('nislinks') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Links Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('nis-notice') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Notice Magazine</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link s">
                        <i class="nav-icon fas fa-solid fa-lightbulb"></i>
                        <p>
                            Innovative Activites Manage
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item d">
                            <a href="{{ URL::to('innovative-links') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Links Manage</p>
                            </a>
                        </li>
                        <li class="nav-item d">
                            <a href="{{ URL::to('innovative-notice') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Notice Magazine</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-chalkboard"></i>
                        <p>
                            Elearning Resources Manage
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('elearning-links') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Links Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('elearning-notice') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Notice Magazine</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

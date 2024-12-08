<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/" class="brand-link text-center">
        <span class="brand-text font-weight-light">SAADAT COLLEGE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mb-2 d-flex justify-content-center align-items-center text-center">
            <div class="info">
                <h2 style="color: rgb(215, 212, 212)"> Welcome {{ Auth::user()->name }}
                </h2>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Starter Pages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Active Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inactive Page</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../../index.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../index2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v3</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="../widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Widgets
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Layout Options
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">6</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../layout/top-nav.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top Navigation</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../layout/top-nav-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top Navigation + Sidebar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../layout/boxed.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Boxed</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../layout/fixed-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Sidebar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../layout/fixed-sidebar-custom.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Sidebar <small>+ Custom Area</small></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../layout/fixed-topnav.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Navbar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../layout/fixed-footer.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fixed Footer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../layout/collapsed-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Collapsed Sidebar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Charts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../charts/chartjs.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ChartJS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../charts/flot.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Flot</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../charts/inline.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inline</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../charts/uplot.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>uPlot</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            UI Elements
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../UI/general.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>General</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../UI/icons.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Icons</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../UI/buttons.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buttons</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../UI/sliders.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sliders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../UI/modals.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Modals & Alerts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../UI/navbar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Navbar & Tabs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../UI/timeline.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Timeline</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../UI/ribbons.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ribbons</p>
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


{{-- <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">

        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">

                    <li><a href="/superadmin">Dashboard</a></li>
                    <li>
                        <a href="{{ URL::to('usermanage') }}">
                            <i class="bi bi-circle"></i><span>USER MANAGE</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ URL::to('faculty') }}">
                            <i class="bi bi-circle"></i><span>FACULTY MANAGE</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('department-entry') }}">
                            <i class="bi bi-circle"></i><span>DEPARTMENT MANAGE</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('menumanage') }}">
                            <i class="bi bi-circle"></i><span>MENU MANAGE</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('submenumanage') }}">
                            <i class="bi bi-circle"></i><span>SUBMENU MANAGE</span>
                        </a>
                    </li>
                    <li>
                    <li>
                        <a href="{{ URL::to('subofsubmenu') }}">
                            <i class="bi bi-circle"></i><span>SUB OF SUBMENU MANAGE</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('news') }}">
                            <i class="bi bi-circle"></i><span>NEWS MANAGE</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('slideshow') }}">
                            <i class="bi bi-circle"></i><span>SLIDE MANAGE</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('events') }}">
                            <i class="bi bi-circle"></i><span>EVENTS MANAGE</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('formsmanage') }}">
                            <i class="bi bi-circle"></i><span>FORMS MANAGE</span>
                        </a>
                    </li>
                    <li><a>PUBLICATONS MANAGE<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ URL::to('journal-of-saadat') }}">
                                    <i class="bi bi-circle"></i><span>JOURNAL OF SAADAT COLLEGE</span>
                                </a>
                            </li>
                            <li><a href="{{ URL::to('college-magazine') }}">COLLEGE MAGAZINES</a></li>
                            <li><a href="{{ URL::to('other-publication') }}">OTHER PUBLICATIONS</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ URL::to('goldenJubileemanage') }}">
                            <i class="bi bi-circle"></i><span>GOLDEN JUBILEE MANAGE</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('bangabandhumanage') }}">
                            <i class="bi bi-circle"></i><span>LIBERATION WAR MANAGE</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('online_portals') }}">
                            <i class="bi bi-circle"></i><span>ONLINE PROTALS MANAGE</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('qucklinks') }}">
                            <i class="bi bi-circle"></i><span>QUICK LINKS MANAGE</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('basicinfo') }}">
                            <i class="bi bi-circle"></i><span>BASIC INFO MANAGE</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('video_clips') }}">
                            <i class="bi bi-circle"></i><span>VIDEO CLIPS MANAGE</span>
                        </a>
                    </li>
                    <li><a>APA LINKS MANAGE<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ URL::to('apalinks') }}">
                                    <i class="bi bi-circle"></i><span>LINKS MANAGE</span>
                                </a>
                            </li>
                            <li><a href="{{ URL::to('apa-notice') }}">NOTICES MANAGE</a></li>
                        </ul>
                    </li>
                    <li><a>NIS LINKS MANAGE<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ URL::to('nislinks') }}">
                                    <i class="bi bi-circle"></i><span>LINKS MANAGE</span>
                                </a>
                            </li>
                            <li><a href="{{ URL::to('nis-notice') }}">NOTICES MANAGE</a></li>
                        </ul>
                    </li>
                    <li><a>INNOVATIVE ACTIVITIES MANAGE<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ URL::to('innovative-links') }}">
                                    <i class="bi bi-circle"></i><span>LINKS MANAGE</span>
                                </a>
                            </li>
                            <li><a href="{{ URL::to('innovative-notice') }}">NOTICES MANAGE</a></li>
                        </ul>
                    </li>
                    <li><a>ELEARNING RESOURCES MANAGE<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ URL::to('elearning-links') }}">
                                    <i class="bi bi-circle"></i><span>LINKS MANAGE</span>
                                </a>
                            </li>
                            <li><a href="{{ URL::to('elearning-notice') }}">NOTICES MANAGE</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ URL::to('complaincornar') }}">
                            <i class="bi bi-circle"></i><span>COMPLAIN CORNER MESSAGE</span>
                        </a>
                    </li>
                </ul>
            </li>




        </ul>
    </div>


</div> --}}
<!-- /sidebar menu -->

{{-- <!-- /menu footer buttons -->
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
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->
</div>
</div> --}}

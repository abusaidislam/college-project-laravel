
            {{-- 
            <li><a><i class="fa fa-edit"></i>Office of the Priccipal MANAGE<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ URL::to('notice_board') }}">Notice Board</a></li>
                    <li><a href="{{ URL::to('noc') }}">NOC</a></li>
                    <li><a href="{{ URL('office_order') }}">Office Order</a></li>
                    <li><a href="{{ URL::to('annual') }}">Annual Committees</a></li>


                </ul>

            </li> --}}




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
                    <a href="{{ URL::to('principaleinfo') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-user"></i>
                        <p>
                           Principal
                        </p>
                    </a>
                </li>
              
                <li class="nav-item">
                    <a href="{{ URL::to('principaledetails') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-file"></i>
                        <p>
                           Principal Details
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('viceprincipalinfo') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-user"></i>
                        <p>
                            Vice-Principal
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('viceprincipaledetails') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-file"></i>
                        <p>
                           Vice-Principal Details
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('massageshow') }}" class="nav-link">
                      <i class="nav-icon fas fa-regular fa-envelope"></i>
                        <p>
                            Principal/Vice-Principal Message
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('academiccouncils') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-school"></i>
                        <p>
                            Academic Council
                        </p>
                    </a>
                </li>
              
                <li class="nav-item">
                    <a href="{{ URL::to('teachercouncil') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-users"></i>
                        <p>
                           Teacher Council
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('teachercouncilhb') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-users"></i>
                        <p>
                            Teacher Council Honour Board
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('exprincipaleinfo') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                         Principal Honour Board
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('exviceprincipal') }}" class="nav-link">
                        <i class="nav-icon fas fa-regular fa-user"></i>
                        <p>
                         Vice-Principal Honour Board
                        </p>
                    </a>
                </li>
              
           </ul>
        </nav>
   
    </div>
    <!-- /.sidebar -->
</aside>

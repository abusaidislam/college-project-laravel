
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
                    <a href="{{ URL::to('hostel-bulding-name') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-hotel"></i>
                        <p>
                            Bulding Manage
                        </p>
                    </a>
                </li>
              
                <li class="nav-item">
                    <a href="{{ URL::to('hostel-floor-name') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-hotel"></i>
                        <p>
                           Bulding Floor Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('hostel-room-number') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-hotel"></i>
                        <p>
                            Room Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('seatallotment') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-bed"></i>
                        <p>
                            Seat Allotment Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('student_recipt_note') }}" class="nav-link">
                      <i class="nav-icon fas fa-solid fa-clipboard"></i>
                        <p>
                            Student Receipt Note
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('hostel-seat-list-view') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-bed"></i>
                        <p>
                            Seat List View
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-credit-card"></i>
                        <p>
                            Hostel ID Card Manage
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('hostelidcard') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hostel ID Card Issue</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('hostelidcardnote') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hostel ID Card Note</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('hostel_logosign') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hostel Logo & Signature</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('hostel_notice_board') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-tag"></i>
                        <p>
                            Notice Board Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('hostel-general-info') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-file"></i>
                        <p>
                            General Info Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('hostel-application-rules') }}" class="nav-link">
                        <i class="nav-icon fas fa-regular fa-images"></i>
                        <p>
                          Application & Rules Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('hostel-head-info') }}" class="nav-link">
                        <i class="nav-icon fas fa-regular fa-user"></i>
                        <p>
                          Hostel Head Info Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('hostel-gallery') }}" class="nav-link">
                        <i class="nav-icon fas fa-regular fa-images"></i>
                        <p>
                            Hostel Gallery Manage
                        </p>
                    </a>
                </li>
           </ul>
        </nav>
   
    </div>
    <!-- /.sidebar -->
</aside>

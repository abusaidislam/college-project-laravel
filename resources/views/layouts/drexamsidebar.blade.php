
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
                    <a href="{{ URL::to('examname') }}" class="nav-link">
                        <i class="nav-icon fas fa-school"></i>
                        <p>
                            Exam Name
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('examcommittee') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Exam Committee Member
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('honorarium_distributes') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Honorarium Distribute
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('exam-buldingname') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Bulding Name Setup
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('exam-room_no') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Room No Setup
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('dranalysis') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            DR Analysis
                        </p>
                    </a>
                </li>
               
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-school"></i>
                        <p>
                            Exam Seat Manage
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                      
                        <li class="nav-item">
                            <a href="{{ URL::to('dr_exam_routine') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>DR Exam Routine</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('drexamseatplan') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>DR Exam Seat Plan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('dr_exam_seat_list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>DR Glance Seat List</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ URL::to('exam_glance_seat_plan') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Glance Seat Plan</p>
                            </a>
                        </li>
                        --}}
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-credit-card"></i>
                        <p>
                            Duty Roaster Management
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                      
                        <li class="nav-item">
                            <a href="{{ URL::to('master-duty-roaster') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Master Duty Roaster</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('examdutyroaster') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Duty Roaster</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('room-wise-master-duty') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Room Wise Invigilator</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('exam_setupplan') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Exam Vigilanc Team</p>
                            </a>
                        </li>
                       
                       
                    </ul>
                </li>
                

            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>


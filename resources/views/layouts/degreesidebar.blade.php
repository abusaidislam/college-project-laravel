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
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
                    <a href="{{ URL::to('degree_background_image') }}" class="nav-link">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Backgorund Image
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('degree_history') }}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            History
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('degree-mission-vision') }}" class="nav-link">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>
                            Mission & Vision
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('degree-headofdepartment') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-school"></i>
                        <p>
                            Head of Department
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('degree-teacher') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-users"></i>
                        <p>
                            Teachers
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('degree-teacher-honour-board') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-users"></i>

                        <p>
                            Teachers Honour Board
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('degree_staff') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-user"></i>
                        <p>
                            Staff Management
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('degree-syllabus') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-newspaper"></i>
                        <p>
                            Syllabus Management
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('degree_photo_galleries') }}" class="nav-link">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Photo Gallery
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('degree-notice') }}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Notice
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('degree-class') }}" class="nav-link">
                        <i class="nav-icon fas fa-school"></i>
                        <p>
                            Class Management
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('degree-class_schedules') }}" class="nav-link">
                        <i class="nav-icon fas fa-school"></i>
                        <p>
                            Class Schedule Management
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ URL::to('degree-course') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Course Management
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-newspaper"></i>
                        <p>
                            Course Fee Management
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('degree-course-fee') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Course Fee Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('degree-regular-fee') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Regular Fee Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                   Ir-Regular Fee 
                                    <i class="fas fa-angle-left right mt-2"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ URL::to('degree-irregular-form-fillup') }}" class="nav-link">
                                        <i class="far fa-arrow nav-icon"></i>
                                        <p>Ir-Regular Form Fillup Fee </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL::to('degree-irregular-nonform-fillup') }}" class="nav-link">
                                        <i class="far fa-arrow nav-icon"></i>
                                        <p>Ir-Regular Non Form Fillup Fee </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL::to('degree-improvement-fee') }}" class="nav-link">
                                        <i class="far fa-arrow nav-icon"></i>
                                        <p>Improvement Fee Manage </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL::to('degree-conditional-fee') }}" class="nav-link">
                                        <i class="far fa-arrow nav-icon"></i>
                                        <p>Conditional Promoted Fee Manage</p>
                                    </a>
                                </li>
                                
        
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('degree-fail-course-fee') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fail Course Fee Management</p>
                            </a>
                        </li>
                    </ul>
                </li>
               

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-newspaper"></i>
                        <p>
                            Students ID Card
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('degree_logo_sign') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ID Card Instruction</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('degree_idcard_note') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ID Card Logo & Signature</p>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-graduation-cap"></i>
                        <p>
                            Students Management
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('degree-first-year-sudetnts') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Degree 1st Year</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('degree-secound-year-students') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Degree 2nd Year</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('degree-third-year-students') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Degree 3rd Year</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ URL::to('degree-fourth-year-students') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Degree 3rd Year</p>
                            </a>
                        </li> --}}

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-marker"></i>
                        <p>
                            Marks Management
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('degree-first-year-result') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>1st Year Marks Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('degree-secound-year-result') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>2nd Year Marks Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('degree-third-year-result') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>3rd Year Marks Manage</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ URL::to('degree-fourth-year-resul') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>4th Year Marks Manage</p>
                            </a>
                        </li> --}}

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-marker"></i>
                        <p>
                            InCourse Marks Management
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('degree-first-year-incourse-mark') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>1st Year Incourse Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('degree-second-year-incourse-mark') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>2nd Year Incourse Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('degree-third-year-incourse-mark') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>3rd Year Incourse Manage</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ URL::to('degree-fourth-year-incourse-mark') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>4th Year Incourse Manage</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ URL::to('degree-result') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Result Management
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ URL::to('degree_inboxinternal_mails') }}" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Inbox
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('degree_sentinternal_mails') }}" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Sent
                        </p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
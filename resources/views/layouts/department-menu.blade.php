
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
                {{-- <a href="#" class="d-block">{{ Auth::user()->name }}</a> --}}
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ URL::to('department_dashboard') }}"
                        class="nav-link {{ request()->is('department-loginaction') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('department_image') }}" class="nav-link">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Backgorund Image
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('department_history') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            History
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('mission-vision') }}" class="nav-link">
                        {{-- <i class="nav-icon fas fa-house-user"></i> --}}
                        <i class="nav-icon fas fa-eye"></i>
                        <p>
                            Mission & Vision
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('headofdepartment') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-school"></i>
                        <p>
                            Head of Department
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('department-teacher') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Teachers
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('teacher-honour-board') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>

                        <p>
                            Teachers Honour Board
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('department_staff') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Staff Management
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('department-syllabus') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-newspaper"></i>
                        <p>
                            Syllabus Management
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('photo_galleries') }}" class="nav-link">
                        <i class="nav-icon fas fa-film"></i>
                        <p>
                            Photo Gallery
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('department-notice') }}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Notice
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('department-class') }}" class="nav-link">
                        <i class="nav-icon fas fa-school"></i>
                        <p>
                            Class Management
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('department-class_schedules') }}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Class Schedule Management
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ URL::to('department-course') }}" class="nav-link">
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
                            <a href="{{ URL::to('department-course-fee') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Course Fee Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('regular-fee') }}" class="nav-link">
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
                                    <a href="{{ URL::to('irregular-form-fillup-fee') }}" class="nav-link">
                                        <i class="far fa-arrow nav-icon"></i>
                                        <p>Ir-Regular Form Fillup Fee </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL::to('irregular-nonform-fillup-fee') }}" class="nav-link">
                                        <i class="far fa-arrow nav-icon"></i>
                                        <p>Ir-Regular Non Form Fillup Fee </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL::to('improvement-fee') }}" class="nav-link">
                                        <i class="far fa-arrow nav-icon"></i>
                                        <p>Improvement Fee Manage </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ URL::to('conditional-promoted-fee') }}" class="nav-link">
                                        <i class="far fa-arrow nav-icon"></i>
                                        <p>Conditional Promoted Fee Manage</p>
                                    </a>
                                </li>
        
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('fail-course-fee') }}" class="nav-link">
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
                            <a href="{{ URL::to('id-card-instruction') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ID Card Instruction</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('id-card-logosign') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ID Card Logo & Signature</p>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>
                            Students Management
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('honours-first-year-students') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Honours 1st Year</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('honours-secound-year-students') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Honours 2nd Year</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('honours-third-year-students') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Honours 3rd Year</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('honours-fourth-year-students') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Honours 4th Year</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('preliminary-masters-students') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Preliminary To Masters</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('masters-Final-students') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Masters Final Students</p>
                            </a>
                        </li>
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
                            <a href="{{ URL::to('students-result-first-year') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>1st Year Marks Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('students-result-second-year') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>2nd Year Marks Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('students-result-third-year') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>3rd Year Marks Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('students-result-fourth-year') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>4th Year Marks Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('preliminary-masters-result') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Preliminary To Masters Year
                                    Marks Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('masters-final-result') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Masters Final Year Marks
                                    Manage</p>
                            </a>
                        </li>
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
                            <a href="{{ URL::to('first-year-incourse-mark') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>1st Year Incourse Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('second-year-incourse-mark') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>2nd Year Incourse Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('third-year-incourse-mark') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>3rd Year Incourse Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('fourth-year-incourse-mark') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>4th Year Incourse Manage</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('preliminary-incourse-mark') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Preliminary Masters Incourse</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('masters-final-incourse-mark') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Masters Final Incourse
                                    Manage</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item">
                    <a href="{{ URL::to('seminar-personnel') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Personnel Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link s">
                        <i class="nav-icon fas fa-solid fa-newspaper"></i>
                        <p>
                            Seminar ID Card
                            <i class="fas fa-angle-left right mt-2"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item d">
                            <a href="{{ URL::to('seminar-id-card') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Seminar ID Card Manage</p>
                            </a>
                        </li>
                        <li class="nav-item d">
                            <a href="{{ URL::to('seminar-card-instruction') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Card Instruction</p>
                            </a>
                        </li>
                        <li class="nav-item d">
                            <a href="{{ URL::to('seminar-logo-sign') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>IDCard Logo & Signature</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('seminar-book-stock') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Book Stock
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('seminar-book-issue') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Book Issue
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('seminar-book-refund') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Book Refund with fine
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('seminar-book-no-return') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Book No Return
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('seminar_notice') }}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Notice Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('seminar_gallery') }}" class="nav-link">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Gallery Manage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('department-inboxinternal_mails') }}" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Inbox
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('departmentsentinternal_mails') }}" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Sent
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ URL::to('department_setting') }}" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Department Setting
                        </p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
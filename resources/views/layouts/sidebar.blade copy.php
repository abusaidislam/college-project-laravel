<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
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


</div>
<!-- /sidebar menu -->

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
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->
</div>
</div>

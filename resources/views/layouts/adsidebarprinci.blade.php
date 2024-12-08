<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">

        <ul class="nav side-menu">
            {{-- <li><a><i class="fa fa-home"></i> Home <span class=""></span></a>

            </li>
            <li><a><i class="fa fa-edit"></i>ADMINISTRATION MANAGE<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ URL::to('principaleinfo') }}">Principal</a></li>
                    <li><a href="{{ URL::to('principaledetails') }}">Principal Details</a></li>
                    <li><a href="{{ URL('viceprincipalinfo') }}">Vice-Principal</a></li>
                    <li><a href="{{ url('viceprincipaledetails') }}">Vice-Principal Details</a></li>
                    <li><a href="{{ url('academiccouncils') }}">Academic Council</a></li>
                    <li><a href="{{ url('teachercouncil') }}">Teacher Council</a></li>
                    <li><a href="{{ url('teachercouncilhb') }}">Teacher Council Honour Board</a></li>

                    <li><a href="{{ url('exprincipaleinfo') }}">Ex-Principal</a></li>
                    <li><a href="{{ url('exviceprincipal') }}">Ex-Vice-Principal</a></li>

                </ul>

            </li> --}}

            <li><a><i class="fa fa-edit"></i>Office of the Priccipal MANAGE<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ URL::to('notice_board') }}">Notice Board</a></li>
                    <li><a href="{{ URL::to('noc') }}">NOC</a></li>
                    <li><a href="{{ URL('office_order') }}">Office Order</a></li>
                    <li><a href="{{ URL::to('annual') }}">Annual Committees</a></li>
                    <li><a href="{{ URL::to('principal_inboxinternal_mails') }}">Inbox</a></li>
                    <li><a href="{{ URL::to('principalsentinternal_mails') }}">Sent</a></li>
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

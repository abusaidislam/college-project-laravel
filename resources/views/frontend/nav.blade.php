<style>
    .navbar-custom {
        background: #1B653D;
    }

    .bg-light {
        background: #1B653D !important;
    }

    .navbar .nav-item .dropdown-menu {
        background: #4F0B73;
    }

    .nav-item a {
        color: white;
    }

    .text-uppercase {
        text-transform: uppercase;
    }


    .dropdown-menu li {
        position: relative;
    }

    .dropdown-menu .dropdown-submenu {
        display: none;
        position: absolute;
        left: 100%;
        top: -7px;
    }

    .dropdown-menu .dropdown-submenu-left {
        right: 100%;
        left: auto;
    }

    .dropdown-menu>li:hover>.dropdown-submenu {
        display: block;
    }
</style>


<nav class="navbar navbar-expand-sm navbar-custom">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-arrow-right"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link text-uppercase" href="{{ url('/') }}">Home</a>
                </li>

                @foreach ($menu as $nmenu)
                    @php
                        $submenu = DB::table('submenus')
                            ->where('menu_id', $nmenu->id)
                            ->get();
                    @endphp
                    <li class="nav-item dropdown">
                        @if ($nmenu->route == '#')
                            <a class="nav-link text-uppercase @if (count($submenu)) dropdown-toggle @endif "
                                href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">{{ $nmenu->title }}</a>
                        @else
                            <a class="nav-link text-uppercase @if (count($submenu)) dropdown-toggle @endif "
                                onclick="window.location.href = '{{ url('menu/' . $nmenu->route . '/' . $nmenu->id) }}';"
                                href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">{{ $nmenu->title }}</a>
                        @endif


                        @if (count($submenu))
                            <ul class=" dropdown-menu dropdown-submenu" aria-labelledby="navbarDropdown">
                                @foreach ($submenu as $nav)
                                    @php
                                        $subsubmenu = DB::table('subofsubmenus')
                                            ->where('sub_id', $nav->id)
                                            ->get();
                                    @endphp
                                    @if (count($subsubmenu) == 0)
                                        <li><a class="nav-link" href="{{ url('/' . $nav->subroute) }}">
                                                {{ $nav->sub_title }} </a></li>
                                    @else
                                        <li>
                                            <a class="nav-link @if (count($submenu)) dropdown-toggle @endif "
                                                onclick="window.location.href = '{{ url('/' . $nav->subroute) }}';"
                                                href="#" id="navbarDropdown{{ $nav->id }}" role="button"
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false">{{ $nav->sub_title }}</a>
                                            <ul class=" dropdown-menu dropdown-submenu"
                                                aria-labelledby="navbarDropdown{{ $nav->id }}">
                                                @foreach ($subsubmenu as $nres1)
                                                    <li> <a class="nav-link"
                                                            href="{{ url('/' . $nres1->route) }}">{{ $nres1->title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
                <li class="nav-item">
                    <a class="nav-link text-uppercase" href="{{ url('/admission') }}">Admission From</a>
                </li>
            </ul>
            <!-- <form class="d-flex">
        <input class="form-control me-2" type="text" placeholder="Search">
        <button class="btn btn-primary" type="button">Search</button>
      </form> -->
        </div>
    </div>

</nav>

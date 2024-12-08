<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            
            <a class="nav-link" data-toggle="dropdown" href="#">
                {{ Auth::user()->name }}
                <i class="fas fa-sign-out-alt"></i>
            </a>
            <div class="dropdown-menu dropdown-usermenu pull-right py-1" style="text-align: center"
                aria-labelledby="navbarDropdown">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="link-secondary text-center"> {{ __('Sign Out') }}</span>
                    </x-dropdown-link>
                </form>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>


{{-- <div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
        </div>
        <nav class="nav navbar-nav">
        <ul class=" navbar-right">
          <li class="nav-item dropdown open" style="padding-left: 0px;">
            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" 
                data-toggle="dropdown" aria-expanded="false">            
            </a>
            <div class="dropdown-menu dropdown-usermenu pull-right py-1" aria-labelledby="navbarDropdown">
                <form method="POST" action="{{ url('department-out') }}">
                @csrf
                <x-dropdown-link :href="url('department-out')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fa fa-sign-out pull-right"></i>
                    <span class="link-secondary"> {{ __('Sign Out') }}</span>
                </x-dropdown-link>
                </form>
            </div>
          </li>
        </ul>
      </nav>
    </div>
  </div> --}}


  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            
            <a class="nav-link" data-toggle="dropdown" href="#">
                {{-- {{ Auth::user()->name }} --}}
                <i class="fas fa-sign-out-alt"></i>
            </a>
            <div class="dropdown-menu dropdown-usermenu pull-right py-1" style="text-align: center"
                aria-labelledby="navbarDropdown">
                <form method="POST" action="{{ url('department-out') }}">
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


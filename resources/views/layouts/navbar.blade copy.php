<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">

        </div>
        <nav class="nav navbar-nav">
        <ul class=" navbar-right">
          <li class="nav-item dropdown open" style="padding-left: 0px;">
            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-usermenu pull-right py-1" aria-labelledby="navbarDropdown">


                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                        <i class="fa fa-sign-out pull-right"></i>
                                         <span class="link-secondary"> {{ __('Sign Out') }}</span>
                                        </x-dropdown-link>
                                    </form>




            </div>
          </li>


        </ul>
      </nav>
    </div>
  </div>

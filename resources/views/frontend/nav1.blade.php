
  <link rel="stylesheet" href="{{asset('frontend/css/nav1.css')}}">
        
<nav id="navbar" class="navbar  bg-white navbar-expand-lg " >

 
        <ul>

         

 <li class="menu  text-uppercase"><a class=" text-uppercase" href="/"><span>home</span> </a>
           @foreach($menu as $nmenu)
 <?php
 $res=DB::table('submenus')->where('menu_id', $nmenu->id)->get();

 ?>
                 @if(count($res)==0)   
              @if(($nmenu->route)=="#")
                <li class="menu"><a class=" text-uppercase"  href="#">{{$nmenu->title}}</a></li>
              @else  
             <li class="menu"><a class=" text-uppercase"  href="{{ url('menu/'.$nmenu->route.'/'.$nmenu->id) }}">{{$nmenu->title}}</li></a>
@endif


 @elseif(count($res)!=0)  
 
  @if(($nmenu->route)=="#")
                
                 <li class="dropdown menu "><a class=" text-uppercase" href="#"><span>{{$nmenu->title}}</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
              @else  
             <li class="dropdown menu "><a class=" text-uppercase" href="{{ url('menu/'.$nmenu->route.'/'.$nmenu->id) }}"><span>{{$nmenu->title}}</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
@endif

             
                <ul>    @foreach($submenu as $nav)
                      <?php  $res1=DB::table('subofsubmenus')->where('sub_id', $nav->id)->get();?>
                      @if($nmenu->id==$nav->menu_id) 
 @if(count($res1)==0) 
                       
                  <li class="submenu"><a href="{{url('/'.$nav->subroute)}}">{{$nav->sub_title}}</a></li>



          
              @elseif(count($res1)>0) 
   <li class="dropdown submenu "><a class="dropdown-item" href="{{url('/'.$nav->subroute)}}" >
    {{$nav->sub_title}}  </a></a>
                <ul> @foreach($res1 as $nres1)
                                         @if($nav->id==$nres1->sub_id) 
                  <li  style="background: red; border: 1px solid white;"><a href="{{url('/'.$nres1->route)}}">{{$nres1->title}}</a></li>  @endif    @endforeach   
                 
                </ul> @endif 
              </li>
 @endif 

                        @endforeach   
                      
            </ul> @endif 
          </li>@endforeach
</ul>
         <i class="bi bi-list mobile-nav-toggle d-none"></i>
      </nav><!-- .navbar -->


<script type="text/javascript">
  /**
   * Mobile nav toggle
   */
  const mobileNavToogle = document.querySelector('.mobile-nav-toggle');
  if (mobileNavToogle) {
    mobileNavToogle.addEventListener('click', function(event) {
      event.preventDefault();

      document.querySelector('body').classList.toggle('mobile-nav-active');

      this.classList.toggle('bi-list');
      this.classList.toggle('bi-x');
    });
  }


    /**
   * Toggle mobile nav dropdowns
   */
  const navDropdowns = document.querySelectorAll('.navbar .dropdown > a');

  navDropdowns.forEach(el => {
    el.addEventListener('click', function(event) {
      if (document.querySelector('.mobile-nav-active')) {
        event.preventDefault();
        this.classList.toggle('active');
        this.nextElementSibling.classList.toggle('dropdown-active'); 

        let dropDownIndicator = this.querySelector('.dropdown-indicator');
        dropDownIndicator.classList.toggle('bi-chevron-up');
        dropDownIndicator.classList.toggle('bi-chevron-down');
      }
    })
  });

  /**
   * Fires the scrollto function on click to links .scrollto
   */
  let selectScrollto = document.querySelectorAll('.scrollto');
  selectScrollto.forEach(el => el.addEventListener('click', function(event) {
    if (document.querySelector(this.hash)) {
      event.preventDefault();

      let mobileNavActive = document.querySelector('.mobile-nav-active');
      if (mobileNavActive) {
        mobileNavActive.classList.remove('mobile-nav-active');

        let navbarToggle = document.querySelector('.mobile-nav-toggle');
        navbarToggle.classList.toggle('bi-list');
        navbarToggle.classList.toggle('bi-x');
      }
      scrollto(this.hash);
    }
  }));
</script>
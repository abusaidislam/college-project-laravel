<div class="profile">
    <h1 class="text-light text-center">
        @foreach ($departments_id as $ndepartments_id)
            {{ $ndepartments_id->name }}
        @endforeach
    </h1>
    @foreach ($headofdepartment as $nheadofdepartment)
        <img src="{{ asset('public/Dhead/' . $nheadofdepartment->photo) }}" alt=""
            class="img-fluid rounded-circle">
    @endforeach
    <h1 class="text-light text-center">Head Of Department</h1>


</div>
<i class="bi bi-list mobile-nav1-toggle d-xl-none"></i>
<nav1 id="nav1bar1" class="nav1-menu nav1bar1">
    <ul>
        <li><a href="#hero" class="nav1-link scrollto border-bottom"><span>Home</span></a></li>
        <li><a href="#histroy" class="nav1-link scrollto border-bottom"> <span>History</span></a></li>
        <li><a href="#mission" class="nav1-link scrollto border-bottom"><span>Mission</span></a></li>
        <li><a href="#teachers" class="nav1-link scrollto border-bottom"> <span>Teachers</span></a></li>
        <li><a href="#honour" class="nav1-link scrollto border-bottom"> <span>Teachers Honour Board</span></a></li>
        <li><a href="#staffs" class="nav1-link scrollto border-bottom"> <span>Staffs</span></a></li>
        {{-- <li><a href="#resume" class="nav1-link scrollto border-bottom"> <span>Students</span></a></li> --}}
        <li><a href="#gallery" class="nav1-link scrollto border-bottom"> <span>Photo Gallery</span></a></li>

        <li><a href="#notice" class="nav1-link scrollto border-bottom"> <span>Notice Board</span></a></li>



    </ul>
</nav1>

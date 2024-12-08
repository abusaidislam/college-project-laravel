@extends('layouts.hosapp')
@section('content')
    <div class="right_col" role="main">
        <div class="py-5 text-center">
            <h1 class=""> WELLCOME TO HOSTEL ADMIN PANEL</h1>
            <h3 class=""> ({{ Auth::user()->name }})</h3>
        </div>
    </div>
    </div>
    </div>
@endsection

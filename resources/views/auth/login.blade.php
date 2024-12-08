@extends('layouts.login-menu')
@section('content')
    <div class="col-lg-6">
        <div class="card2 card border-0 px-4 py-5">
            <div class="row mb-4 px-3">

                <div class=" text-center mr-3"> <a href="login"> <button type="button"
                            class="btn btn-outline-primary  mx-1">Admin</button></a></div>
                <div class=" text-center mr-3"> <a href="/department-login"><button type="button"
                            class="btn btn-outline-primary mx-1">Department </button></a></div>

            </div>
            <div>
                <h2> Admin Login</h2>
            </div>
            <div class="row px-3 mb-4">
                <div class="line"></div>

                <div class="line"></div>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row px-3">
                    <label class="mb-1">
                        <h6 class="mb-0 text-sm">Email Address</h6>
                    </label>

                    <input class="mb-4" type="text" name="email" placeholder="Enter a valid email address"
                        value="{{ old('email') }}">
                    <span class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="row px-3">
                    <label class="mb-1">
                        <h6 class="mb-0 text-sm">Password</h6>
                    </label>
                    <input type="password" name="password" placeholder="Enter password">
                    <span class="text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="row px-3 mt-3">
                    <button type="submit" class="btn btn-blue text-center">Login</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <div class="bg-blue py-4">
        <div class="row px-3">
            <small class="ml-4 ml-sm-5 mb-2" id="copyright-text">Copyright &copy; </small>
            <div class="social-contact ml-4 ml-sm-auto">

            </div>
        </div>
    </div>
    </div>
    </div>
    <script>
        var currentYear = new Date().getFullYear();
        document.getElementById('copyright-text').innerHTML += currentYear + '. All rights reserved.';
    </script>

    </section>
@endsection

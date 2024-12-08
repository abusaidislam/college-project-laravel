


    <div class="container ">


        <div class="row ">
          <div class="ccolor col-lg-4 text-center text-lg-left ">
            <a class="mr-3" href="callto:+443003030266"><strong>CALL</strong> {{$basic->mobile_no}}</a>
            <ul class="list-inline d-inline">
              <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="{{$basic->facebook}}"><i class="fa fa-facebook"></i></a></li>
              <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="{{$basic->twitter}}"><i class="fa fa-twitter"></i></a></li>
              <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="{{$basic->twitter}}"><i class="fa fa-instagram"></i></a></li>
              <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="{{$basic->instragram}}"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>
        
          <div class="col-lg-8 text-center text-lg-end ">
            <ul class="list-inline">
              <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#">notice</a></li>
              <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#">research</a></li>
              <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#">SCHOLARSHIP</a></li>
              <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="{{ route('login') }}" data-bs-toggle="modal" data-bs-target="#loginModal" >login</a></li>
             
            </ul>
          </div>
        </div>
      </div>
    </div>



  <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content rounded-0 border-0 p-4">
              <div class="modal-header border-0">
                  <h3>Register</h3>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="login">
                    <form method="POST"  action="{{ route('register') }}">
                        @csrf

                          <div class="col-12">
                            <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="col-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="col-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password(min:8digit)" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="col-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="RePassword" required autocomplete="new-password">
                          </div>
                          <div class="col-12">
                              <button type="submit" class="btn btn-primary">SIGN UP</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content rounded-0 border-0 p-4">
              <div class="modal-header border-0">
                  <h3>Login</h3>

                   <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="{{ route('login') }}">
                      @csrf

                      <div class="form-group">
                          <input  placeholder="Your email address..."   id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                          @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>

      <div class="form-group">
      <input id="password" type="password" placeholder="Your password..." class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

  @error('password')
  <span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
  </span>
  @enderror
      </div>

                          <button type="submit"  class="btn btn-info btn-block btn-round"">
                              {{ __('Login') }}
                          </button>



    </form>
              </div>
          </div>
      </div>
  </div>

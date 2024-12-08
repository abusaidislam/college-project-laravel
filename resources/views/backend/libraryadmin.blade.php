@extends('layouts.libaryapp')
@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-3 col-6">
              <div class="small-box bg-info shadow">
                  <div class="inner">
                      <h3>{{$librarian ?? ""}}</h3>
                      <p>Library Personnel</p>
                  </div>
                  <div class="icon">
                      <i class="fas fa-users"></i>
                  </div>
                  <a href="{{url('library_personnel')}}" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
              <div class="small-box bg-success shadow">
                  <div class="inner">
                      <h3>{{$libraryStudent ?? ""}}</h3>
                      <p>Library Students</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-solid fa-user-graduate"></i>
                  </div>
                  <a href="{{url('slibrary_card')}}" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
              <!-- small card -->
              <div class="small-box bg-warning shadow">
                  <div class="inner">
                      <h3>{{$bookstock ?? ""}}</h3>
                      <p>Boot Stocks</p>
                  </div>
                  <div class="icon">
                      <i class="fas fa-book"></i>
                  </div>
                  <a href="{{url('bookstock')}}" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
              <!-- small card -->
              <div class="small-box bg-danger shadow">
                  <div class="inner">
                      <h3>{{$libraryNotice ?? ""}}</h3>
                      <p>Library Notice</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-solid fa-file"></i>
                  </div>
                  <a href="{{url('library_notice')}}" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>
          <!-- ./col -->
      </div>
   
  </div><!-- /.container-fluid -->
</div>
  @endsection

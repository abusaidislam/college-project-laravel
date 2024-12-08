<div id="demo" class="carousel slide" data-bs-ride="carousel">

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    @foreach($slide as $nslide)
      <button type="button" data-bs-target="#demo" data-bs-slide-to="{{ $loop->index }}" class="active"></button>
    @endforeach 
  </div>
  
  <!-- The slideshow/carousel -->
  <div class="carousel-inner">
   
    @foreach($slide as $nslide)
      <div class="carousel-item @if($loop->index == 1) active @endif">
        <img src="{{asset('public/slide/'.$nslide->image)}}" alt="{{$nslide->title}}" class="d-block" style="width:100%">
        <div class="carousel-caption">
          <h3 style="background-color: #4f0b7399; color:white; padding:4px;">{{$nslide->title}}</h3>
          <p style="background-color: #4f0b7399; color:white; padding:4px;">{{$nslide->description}}</p>
        </div>
      </div>
    @endforeach 
  </div>
  
  <!-- Left and right controls/icons -->
  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

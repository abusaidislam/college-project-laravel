@extends('layouts.master')
@section('content')
<style type="text/css">
        #map {
          height: 400px;
        
        }
    </style>
  <!-- About Start -->
    <div class="  py-5  px-4 bg-white">
     
            <div class="row g-5">
            <div id="map"></div>
                   
               
            </div>
     
    </div>
    <!-- About End -->
    <script type="text/javascript">
        function initMap() {
          const myLatLng = { lat: 24.22069433, lng: 89.9761961 };
          const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 5,
            center: myLatLng,
          });
  
          new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Hello Rajkot!",
          });
        }
  
        window.initMap = initMap;
    </script>
  
    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" ></script>
   @endsection
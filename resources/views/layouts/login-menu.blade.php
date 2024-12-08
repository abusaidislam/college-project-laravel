<!doctype html>
<html lang="en">
  <head>
    <title>Login </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="frontend/css/lstyle.css">

    </head>
    <body>

 
 <style type="text/css">body {
    color: #000;
    overflow-x: hidden;
    height: 100%;
    background-color: #B0BEC5;
    background-repeat: no-repeat;
}

.card0 {
    box-shadow: 0px 4px 8px 0px #757575;
    border-radius: 0px;
}

.card2 {
    margin: 0px 40px;
}

.logo {
    width: 200px;
    height: 100px;
    margin-top: 20px;
    margin-left: 35px;
}

.image {
    width: 360px;
    height: 280px;
}

.border-line {
    border-right: 1px solid #EEEEEE;
}

.facebook {
    background-color: #3b5998;
    color: #fff;
    font-size: 18px;
    padding-top: 5px;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    cursor: pointer;
}

.twitter {
    background-color: #1DA1F2;
    color: #fff;
    font-size: 18px;
    padding-top: 5px;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    cursor: pointer;
}

.linkedin {
    background-color: #2867B2;
    color: #fff;
    font-size: 18px;
    padding-top: 5px;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    cursor: pointer;
}

.line {
    height: 1px;
    width: 100%;
    background-color: #E0E0E0;
    margin-top: 10px;
}

.or {
    width: 10%;
    font-weight: bold;
}

.text-sm {
    font-size: 14px !important;
}

::placeholder {
    color: #BDBDBD;
    opacity: 1;
    font-weight: 300
}

:-ms-input-placeholder {
    color: #BDBDBD;
    font-weight: 300
}

::-ms-input-placeholder {
    color: #BDBDBD;
    font-weight: 300
}

input, textarea {
    padding: 10px 12px 10px 12px;
    border: 1px solid lightgrey;
    border-radius: 2px;
    margin-bottom: 5px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    color: #2C3E50;
    font-size: 14px;
    letter-spacing: 1px;
}

input:focus, textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #304FFE;
    outline-width: 0;
}

button:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0;
}

a {
    color: inherit;
    cursor: pointer;
}

.btn-blue {
    background-color: #1A237E;
    width: 150px;
    color: #fff;
    border-radius: 2px;
}

.btn-blue:hover {
    background-color: #000;
    cursor: pointer;
}

.bg-blue {
    color: #fff;
    background-color: #1A237E;
}

@media screen and (max-width: 991px) {
    .logo {
        margin-left: 0px;
    }

    .image {
        width: 300px;
        height: 220px;
    }

    .border-line {
      
    }

    .card2 {
        border-top: 1px solid #EEEEEE !important;
        margin: 0px 15px;
    }
}</style>


        

  


            
<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row">
                    <div class="col-lg-3">    <img src="{{asset('public/basic/logo1.png')}}" style="width: 100px; height: 100px;" class="logo"></div>
                        <div class="col-lg-9"> <div class="row bg-white ">
    
    
   
<div class="col-md-12 text-center pt-2" style="line-height: 20px; font-family: Times new roman;color:#2f5396; font-size: 18px; " >The Government of the Peoples Republic of Bangladesh
<h2 class="pt-2" style="color:#2f5396;  font-family: Times new roman; line-height: 30px;"> Government Saadat College</h2>
<p class="p-0"  style="color:#2f5396; font-size: 16px; font-family: Times new roman; line-height: 5px;">Karatia, Tangail-1903</p>
<p class="p-0" style="color:#2f5396; font-size: 16px; font-family: Times new roman; line-height: 5px;">Established: 1926</p>
<p class="text-dark" style="color:#2f5396;font-size: 16px; font-family: Times new roman; line-height: 12px;" >College Code: 0070, NU Code: 5301, EIIN: 114747</p></div>

 
</div></div>

                    </div> <div class=" text-center line"></div>
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                        <img src="{{asset('public/basic/login.png')}}" class="image">
                    </div>
                </div>
            </div>

 






@yield('content')












    <script src="frontend/js1/jquery.min.js"></script>
  <script src="frontend/js1/popper.js"></script>
  <script src="frontend/js1/bootstrap.min.js"></script>
  <script src="frontend/js1/main.js"></script>

    </body>
</html>
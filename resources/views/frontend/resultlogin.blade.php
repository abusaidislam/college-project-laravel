<!DOCTYPE html>
<html lang="en">
<head>
  <title>Saadat College</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}
<style>
    #div1color{
     border-radius: 5px;
    background: #c9c9c9;
    box-shadow: 0px 3px 1px 9px greenyellow;
    }
</style>

</head>
<body>

<div class="container">
    <div class="row justify-content-center" style="margin-top:200px" >
        <div class="col-md-5 col-sm-5" id="div1color">
            <div class="">
                <h3 class="text-center">Government Saadat College</h3>
                <h6 class="text-center">Results Archive</h6>
                <hr>
            </div>
           
            <form class="p-3 " action="{{url('studentresult')}}" method="post">
                @csrf
                <div class="form-group row">
                  <label for="roll" class="col-sm-4 col-form-label">Exam. Roll:</label>
                  <div class="col-sm-6 col-md-6">
                    <input type="text" class="rounded" name="roll" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="reg" class="col-sm-4 col-form-label">Registraion:</label>
                  <div class="col-sm-6 col-md-6">
                    <input type="text" class="rounded" name="reg" required >
                  </div>
                </div>
                <div class="form-group row">
                    <label for="year" class="col-sm-4 col-form-label">Exam. Year:</label>
                    <div class="col-sm-6 col-md-6">
                      <input type="text" class="rounded" name="year" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-6 col-md-6">
                        <button type="submit" class="rounded">Search Result</button>
                    </div>
                  </div>
              </form>
        </div>
      
    </div>

</div>

</body>
</html>

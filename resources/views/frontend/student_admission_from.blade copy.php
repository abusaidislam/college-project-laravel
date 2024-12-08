
@extends('layouts.master')
@section('content')

  <!-- About Start -->
    <div class=" py-5 bg-white">
        <div class="container bg-info" style="min-height: 500px">
            @if(session('message'))
               <h1>{{ session('message') }}</h1>
            @endif
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <form method="POST" action="{{ url('admission-login') }}"
                            id="myForm" enctype="multipart/form-data">
                            @csrf()
                            <input type="hidden" name="id" id="id">
                            <div class="form-group mt-3">
                                <label for="" class="col-sm-12 control-label">Department Name :</label>
                                <div class="col-sm-12">
                                   <input class="form-control" type="text" id="depart_ids"  name="depart_id" value="{{$department->name}}" readonly required>
                                </div>
                            </div>
                            {{-- General Deparment user Id 17 this id Department Id 17 mathch so new value 40 fiexd --}}
                            <div class="form-group mt-3">
                                <label for="" class="col-sm-12 control-label">Class Name :</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="text" id="class_ids"  name="class_id" value="{{$className->name}}" readonly required>
                                </div>
                            </div>
                            <div class="mb-3 mt-3">
                              <label for="sname" class="form-label">Student Name:</label>
                              <input type="text" class="form-control" id="snames" placeholder="Student Name" name="sname" value="{{$Student1stYear->name}}">
                            </div>
    
                            <div class="form-group mt-3">
                                <label for="" class="col-sm-12 control-label">Session :</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" id="sessions" placeholder="Session" name="session" value="{{$Student1stYear->session}}">
                                </div>
                            </div>
    
                            <div class="form-group mt-3">
                                <label for="" class="col-sm-12 control-label">Roll :</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="roll" name="roll"
                                        placeholder="Student Roll " value="{{$Student1stYear->roll}}">
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label for="home_dis" class="col-sm-12 control-label">Registration</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="registration"
                                        name="registration" placeholder="Student Registration" value="{{$Student1stYear->registration_no}}">
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label for="regi_type" class="col-sm-12 control-label">Registration  Type :</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="regi_type" name="regi_type" required>
                                        <option class="" value="" selected>--Select --</option>
                                        <option class="" value="regular" >Regular</option>
                                        <option class="" value="ir-regular" >Ir-Regular</option>
                                        <option class="" value="imporvement" >Imporvement</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label for="regi_type" class="col-sm-12 control-label">Course Code :</label>
                                <div class="col-sm-12">
                                 <textarea name="" id="" cols="50" rows="5">
                                    @foreach ($courseName as $item)
                                       {{$item->course_code}}, 
                                    @endforeach
                                 </textarea>
                                </div>
                            </div>
                            {{-- <div class="form-group mt-3">
                                <label for="imageInput" class="col-sm-12 control-label">Upload Image:</label>
                                <div class="col-sm-12">
                                    <input type="file" id="imageInput">
                                </div>
                            </div>
                            <input type="text"  id="textInput"> --}}
                            {{-- <textarea id="textInput" cols="30" rows="10" readonly></textarea> --}}
                            {{-- <div id="imagePreview"></div>  --}}
                            {{-- <div>
                                <label for="imageInput">Upload Image:</label>
                                <input type="file" id="imageInput">
                                <button id="processButton">Process Image</button>
                            </div>
                            <div id="textOutput"></div>   <br><br> --}}
                            <div class="form-group mt-3">
                            <label for="input_image">Choose an Image File:</label>
                        <input type="file" id="input_image" name="input_image"/><br /><br />
                        <textarea cols="50" rows="5" id="image-text"></textarea><br/><br/>
                        <progress id="progressbar" min="0" max="1" value="0"/><br/>
                            </div>
                            <div>
                                <label for="amountInput">Amount (BDT):</label><br>
                                <input type="text" id="amountInput">
                            </div><br>
                            <button id="extractdata">Extract Amount</button>
                        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                    </form><br>
                   
                </div> 
            </div>
        </div>
    </div>
    <!-- About End -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    {{-- <script src='https://unpkg.com/tesseract.js@2.1.0/dist/tesseract.min.js'></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/tesseract.js@2.1.0/dist/tesseract.min.js"></script> --}}
    <script src='https://cdn.rawgit.com/naptha/tesseract.js/1.0.10/dist/tesseract.js'></script>
    <script>
         document.addEventListener('DOMContentLoaded', function(){
            var input_image = document.getElementById('input_image');
            input_image.addEventListener('change', handleInputChange);
        });

        function handleInputChange(event){
            var input = event.target;
            var file = input.files[0];
            console.log(file);
            Tesseract.recognize(file)
                .progress(function(message){
                    document.getElementById('progressbar').value = message.progress;
                    // console.log(message);
                })
                .then(function(result){
                    var contentArea = document.getElementById('image-text');
                    contentArea.innerHTML = result.text;
                    // console.log(result);
                    extractAmount(result.text);
                })
                .catch(function(err){
                    console.error(err);
                });
                
        }

    </script>
    <script>
       $(document).ready(function() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('#extractdata').on('click', function() {
        var textValue = $('#image-text').val();
        
        // Regular expressions to match the numbers after specific strings
        var amountRegex = /Amnunt\(BDT\)Z\s*([\d,.]+)/;
        var inWordRegex = /In\sWord:\s*([\d,.]+)/;
        
        // Match the amount and inWord
        var amountMatch = textValue.match(amountRegex);
        var inWordMatch = textValue.match(inWordRegex);
        
        // Extract the numbers from matches
        var amount = amountMatch ? amountMatch[1] : 'Amount not found';
        var inWord = inWordMatch ? inWordMatch[1] : 'Amount not found';

        // Set the values in input fields
        $('#amountInput').val(amount);
        $('#inWordInput').val(inWord);
    });
  


});

    </script>
    
    {{-- <script>
        document.getElementById('processButton').addEventListener('click', function() {
            const fileInput = document.getElementById('imageInput');
            const file = fileInput.files[0];
            if (!file) {
                console.error('No image selected.');
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    Tesseract.recognize(img.src, 'eng', { logger: m => console.log(m) })
                        .then(function(result) {
                            const textOutput = document.getElementById('textOutput');
                            if (textOutput) {
                                textOutput.innerText = result.text;
                            } else {
                                console.error('Text output element not found.');
                            }
                        })
                        .catch(function(error) {
                            console.error('Error recognizing text:', error);
                        });
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
        // document.getElementById('imageInput').addEventListener('change', function(event) {
        //     const file = event.target.files[0];
        //     const reader = new FileReader();

        //     reader.onload = function(e) {
        //         const img = new Image();
        //         img.onload = function() {
        //             Tesseract.recognize(img)
        //                 .then(function(result) {
        //                     document.getElementById('textInput').innerText = result.text;
        //                 })
        //                 .catch(function(error) {
        //                     console.error('Error recognizing text:', error);
        //                 });
        //         };
        //         img.src = URL.createObjectURL(file);

        //         // Display uploaded image
        //         const imagePreview = document.getElementById('imagePreview');
        //         imagePreview.innerHTML = '';
        //         const uploadedImage = new Image();
        //         uploadedImage.src = img.src;
        //         uploadedImage.style.maxWidth = '100%';
        //         uploadedImage.style.maxHeight = '300px'; // Adjust as needed
        //         imagePreview.appendChild(uploadedImage);
        //     };
        //     reader.readAsDataURL(file);
        // });
    </script> --}}
   @endsection
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @extends('layouts.department')
  @section('title', 'Sent Email Manage |')
  @section('content')
    <style type="text/css">
        /*    --------------------------------------------------
                        :: General
                        -------------------------------------------------- */


        /*  --------------------------------------------------
                        :: Table Filter
                        -------------------------------------------------- */
        .panel {
            border: 1px solid #ddd;
            background-color: #fcfcfc;
        }

        .panel .btn-group {
            margin: 15px 0 30px;
        }

        .panel .btn-group .btn {
            transition: background-color .3s ease;
        }

        .table-filter {
            background-color: #fff;
            border-bottom: 1px solid #eee;
        }

        .table-filter tbody tr:hover {
            cursor: pointer;
            background-color: #eee;
        }

        .table-filter tbody tr td {
            padding: 10px;
            vertical-align: middle;
            border-top-color: #eee;
        }

        .table-filter tbody tr.selected td {
            background-color: #eee;
        }

        .table-filter tr td:first-child {
            width: 38px;
        }

        .table-filter tr td:nth-child(2) {
            width: 35px;
        }

        .ckbox {
            position: relative;
        }

        .ckbox input[type="checkbox"] {
            opacity: 0;
        }

        .ckbox label {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .ckbox label:before {
            content: '';
            top: 1px;
            left: 0;
            width: 18px;
            height: 18px;
            display: block;
            position: absolute;
            border-radius: 2px;
            border: 1px solid #bbb;
            background-color: #fff;
        }

        .ckbox input[type="checkbox"]:checked+label:before {
            border-color: #2BBCDE;
            background-color: #2BBCDE;
        }

        .ckbox input[type="checkbox"]:checked+label:after {
            top: 3px;
            left: 3.5px;
            content: '\e013';
            color: #fff;
            font-size: 11px;
            font-family: 'Glyphicons Halflings';
            position: absolute;
        }

        .table-filter .star {
            color: #ccc;
            text-align: center;
            display: block;
        }

        .table-filter .star.star-checked {
            color: #F0AD4E;
        }

        .table-filter .star:hover {
            color: #ccc;
        }

        .table-filter .star.star-checked:hover {
            color: #F0AD4E;
        }

        .table-filter .media-photo {
            width: 35px;
        }

        .table-filter .media-body {
            display: block;
            /* Had to use this style to force the div to expand (wasn't necessary with my bootstrap version 3.3.6) */
        }

        .table-filter .media-meta {
            font-size: 15px;
            color: #999;
        }

        .table-filter .media .title {
            color: #2BBCDE;
            font-size: 14px;
            font-weight: bold;
            line-height: normal;
            margin: 0;
        }

        .table-filter .media .title span {
            font-size: .8em;
            margin-right: 20px;
        }

        .table-filter .media .title span.pagado {
            color: #5cb85c;
        }

        .table-filter .media .title span.pendiente {
            color: #f0ad4e;
        }

        .table-filter .media .title span.cancelado {
            color: #d9534f;
        }

        .table-filter .media .summary {
            font-size: 14px;
        }
    </style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
              <div class="col-md-12 col-sm-12 ">
                  <div class="x_panel">
                      <div class="x_title">
                          <h2>Sent Email</h2>
                          <ul class="nav navbar-right panel_toolbox">
                              <li><span class="input-group-btn">
                                      <a class="btn btn-success my-2" href="javascript:void(0)" id="createNew"> Composer
                                      </a>
                                  </span>
                              </li>

                          </ul>
                          <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="card-box table-responsive">


                                      <table class="table table-filter">
                                          <tbody>
                                              @foreach ($data as $ndata)
                                                  <tr data-status="pagado">
                                                      <td>
                                                          <div class="ckbox">
                                                              <a href="{{ url('/sentmail-delete/' . $ndata->id) }}"><button
                                                                      class="btn btn-danger">Delete</button></a>

                                                          </div>
                                                      </td>
                                                      <td>

                                                      </td>
                                                      <td>
                                                          <div class="media">



                                                              <div class="media-body">

                                                                  <h4 class="title">
                                                                      To: {{ $ndata->receiver }}

                                                                  </h4>
                                                      <td>
                                                          @if ($ndata->status == 0)
                                                              <a href="department_sentmaildetails/{{ $ndata->id }}"
                                                                  style="color: blue;  "><b>{{ $ndata->subject }}...</b></a>
                                                          @else
                                                              <a href="department_sentmaildetails/{{ $ndata->id }}"
                                                                  style="color: black;">{{ $ndata->subject }}...</a>
                                                          @endif
                                                          <span
                                                              class="media-meta pull-right">{{ date('M', strtotime($ndata->created_at)) }}
                                                              {{ date('d', strtotime($ndata->created_at)) }},
                                                              {{ date('Y', strtotime($ndata->created_at)) }}</span>
                                                      </td>

                                  </div>
                              </div>
                              </td>
                              </tr>
                              @endforeach

                              </tbody>
                              </table>

                              {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal fade bd-example-modal-lg" id="ajaxModel" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                          <div class="modal-body">
                              <form method="POST" id="addform" name="form" class="form-horizontal"
                                  action="{{ url('departmentstore') }}" enctype="multipart/form-data">
                                  @csrf()

                                  <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group ">
                                            <label for="name" class="col-sm-12 control-label">Subject</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="subject" name="subject"
                                                    placeholder=" subject" value="" required="">
                                            </div>
                                        </div>
                                        </br>
                                        <div class="form-group">
                                            <label for="route" class="col-sm-12 control-label">receiver</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="receiver" name="receiver"
                                                    placeholder="receiver" value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group "> <label> </label>
                                            <div class="col-sm-12 pt-3">
                                                <label><input type="checkbox" name="alldepartment" id="alldepartment"
                                                        value="1" onclick="myFunction()"> All Department</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="photo" class="col-sm-12 control-label">mail</label>
                                            <div class="col-sm-12">
                                                <textarea class="summernote" placeholder="Enter mail" id="mail"name="mail"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="photo" class="col-sm-12 control-label">File 1 </label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="photo" name="photo"
                                                    placeholder="Enter File" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="photo" class="col-sm-12 control-label">File 2</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="photo1" name="photo1"
                                                    placeholder="Enter File1" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="photo" class="col-sm-12 control-label">File 3</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="photo2" name="photo2"
                                                    placeholder="Enter File 2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="photo" class="col-sm-12 control-label">File 3</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="photo3" name="photo3"
                                                    placeholder="Enter File 3" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="photo" class="col-sm-12 control-label">File 4</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="photo4" name="photo4"
                                                    placeholder="Enter File 4" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  <div class=" col-sm-offset-2 col-sm-10 my-2">
                                      <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                      <button type="button" class="btn btn-danger " id="close"
                                          data-bs-dismiss="modal" aria-label="Close">Close</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>


          </div>
      </div>
      </div>
    </div>
</div>

      <script type="text/javascript">
          $(document).ready(function() {


              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              })



          });


          $('#createNew').click(function() {
              $('#ajaxModel').modal('show');
              $('#modelHeading').html("New Message");
              $('#form').trigger("reset");
              $('#saveBtn').html('Save');
              $('#id').val('');


              //var x = document.getElementById("gallery");
              //x.style.display = "none";
          });

          function myFunction() {
              var checkBox = document.getElementById("alldepartment");

              if (checkBox.checked == true) {
                  document.getElementById('receiver').disabled = true;
              } else {
                  document.getElementById('receiver').disabled = false;
              }
          }

          /*------------------------------------------
          --------------------------------------------
          Click to Edit Button
          --------------------------------------------
          --------------------------------------------*/
          $('body').on('click', '#edit', function() {
              var id = $(this).data('id');
              $.get("{{ route('sentinternal_mails.index') }}" + '/' + id + '/edit', function(data) {
                  $('#modelHeading').html("Edit");
                  $('#saveBtn').html('Update');
                  $('#ajaxModel').modal('show');
                  $('#id').val(data.id);
                  $('#subject').val(data.subject);
                  $('#sender').val(data.sender);
                  $('#receiver').val(data.receiver);
                  $('#mail').summernote('code', data.mail);
                  $('#photo').val(data.photo);
              });
          });

          $('body').on('click', '#delete', function() {
            var id = $(this).data("id");
            Swal.fire(sweetAlertConfirmation).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: 'dchange_status/' + id,
                        success: function(data) {
                            window.location = 'dchange_status';
                            const Toast = Swal.mixin(toastConfiguration);
                            Toast.fire({
                                icon: "success",
                                title: "Deleted Successfully!!!"
                            });
                        }
                    });
                }
            });
            return false;
        });


          $('#close').click(function() {
              $('#ajaxModel').modal('hide');

          });
      </script>
  @endsection

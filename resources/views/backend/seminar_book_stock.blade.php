@extends('layouts.department')
@section('title', 'Book Stock Manage |')
@section('content')
<div class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Seminar Book Stock</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                     <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
                                 </span>
                              </li>
                              <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-primary" href="{{ url('/seminar_book_stock_pdf') }}" id=""> Download
                                        PDF
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


                                    <table id="datatable-responsive"
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>Photo</th>
                                                <th>Author</th>
                                                <th>Book Name</th>
                                                <th>Number Of Copies</th>
                                                <th>Current Number <br> Of Copies</th>
                                                <th>Publication</th>
                                                <th>Edition</th>
                                                <th>Volumn</th>
                                                <th>Purchase Date</th>
                                                <th>Accession Number</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                @php
                                                    $bookissues = DB::table('seminar_book_issues')
                                                        ->where('book_id', $ndata->id)
                                                        ->get();
                                                    $booksrefund = DB::table('seminar_book_refunds')
                                                        ->Join('seminar_book_issues', 'seminar_book_issues.date_of_return_book', '=', 'seminar_book_refunds.date_of_return')
                                                        ->where('seminar_book_refunds.book_id', $ndata->id)
                                                        ->get();
                                                    $sumBooks = $bookissues->sum('number_of_book');
                                                    $remainingbook = is_numeric($ndata->number_of_copies) ? $ndata->number_of_copies - $sumBooks : 0;
                                                    $sumsreminginbook = $booksrefund->sum('numberofbook');
                                                    $totalsum = $remainingbook + $sumsreminginbook;

                                                @endphp
                                                <tr>
                                                    <td><img src="{{ asset('public/library_book/' . $ndata->photo) }}"
                                                            alt="" width="80" height="80"></td>
                                                    <td>{{ $ndata->author }} </td>
                                                    <td>{{ $ndata->book_name }}</td>
                                                    <td>{{ $ndata->number_of_copies }}</td>
                                                    <td>{{ $totalsum }}</td>
                                                    <td>{{ $ndata->publiction }} </td>
                                                    <td>{{ $ndata->edition }} </td>
                                                    <td>{{ $ndata->volumn }} </td>
                                                    <td>{{ $ndata->date }} </td>
                                                    <td>{{ $ndata->accession_number }} </td>
                                                    <td>{{ $ndata->price }} </td>
                                                    <td>{{ $ndata->status == 0 ? 'Active' : 'Inactive' }}</td>
                                                    <td><button type="button" id="edit" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-info">Edit</button>
                                                        <button type="button" id="delete" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-danger">Delete</button>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>


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
                                    <form method="POST" id="form" name="form" class="form-horizontal"
                                        action="{{ route('seminar-book-stock.store') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="id" id="id">
                                       <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="author" class="col-sm-12 control-label">Author Name</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="author" name="author"
                                                            placeholder="Enter Author Name" value="" maxlength="150"
                                                            required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-12 control-label">Book Name</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="book_name" name="book_name"
                                                            placeholder="Enter Book Name" value="" maxlength="50"
                                                            required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="publiction" class="col-sm-3 control-label">Publication</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="publiction" name="publiction"
                                                            placeholder="Enter Publication" value="" required="">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="number_of_copies" class="col-sm-12 control-label">Number Of
                                                        Copies</label>
                                                    <div class="col-sm-12">
                                                        <input type="number" class="form-control" id="number_of_copies"
                                                            name="number_of_copies" placeholder="Enter Number Of Copies"
                                                            value="" maxlength="50" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edition" class="col-sm-3 control-label">Edition</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="edition" name="edition"
                                                            placeholder="Enter Edition" value="" required="">
                                                    </div>
                                                </div>
                                           
                                                <div class="form-group">
                                                    <label for="volumn" class="col-sm-12 control-label">Volumn</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="volumn" name="volumn"
                                                            placeholder="Enter Volumn" value="" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="date" class="col-sm-12 control-label">Purchase Date</label>
                                                    <div class="col-sm-12">
                                                        <input type="date" class="form-control" id="date" name="date"
                                                            placeholder="Enter Purchase Date" value="" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="accession_number" class="col-sm-12 control-label">Accession Number</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="accession_number" name="accession_number"
                                                            placeholder="Enter Accession Number" value="" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="price" class="col-sm-12 control-label">Price</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="price" name="price"
                                                            placeholder="Enter Price" value="" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="photo" class="col-sm-12 control-label">Photo
                                                        (Dimensions:530x650, Max-Size:200kb)</label>
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control" id="photo" name="photo"
                                                            placeholder="Enter Photo" value="">
                                                        <span class="text-danger">
                                                            @error('photo')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status" class="col-sm-12 control-label">Status</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control  " name="status" id="status">
                                                            <option class="" value="0" selected>Active</option>
                                                            <option class="" value="1">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class=" col-sm-offset-2 col-sm-10 my-2">

                                            <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                            <button type="button" class="btn btn-danger" id="closemodal"
                                                aria-label="Close">
                                                close
                                            </button>
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
            $('#modelHeading').html("Create New");
            $('#form').trigger("reset");
            $('#saveBtn').html('Save');
            $('#id').val('');


        });
        /*------------------------------------------
                  --------------------------------------------
                  Click to Edit Button
                  --------------------------------------------
                  --------------------------------------------*/
        $('body').on('click', '#edit', function() {
            var id = $(this).data('id');
            $.get("{{ route('seminar-book-stock.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#book_name').val(data.book_name);
                $('#number_of_copies').val(data.number_of_copies);
                $('#author').val(data.author);
                $('#publiction').val(data.publiction);
                $('#edition').val(data.edition);
                $('#volumn').val(data.volumn);
                $('#date').val(data.date);
                $('#accession_number').val(data.accession_number);
                $('#price').val(data.price);

            })
        });

        /*------------------------------------------
                   --------------------------------------------
                   Delete ndataInfo Code
                   --------------------------------------------
                   --------------------------------------------*/
        $('body').on('click', '#delete', function() {
            var id = $(this).data("id");
            Swal.fire(sweetAlertConfirmation).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: 'seminar-book-stock/' + id,
                        success: function(data) {
                            window.location = 'seminar-book-stock';
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

        $('#closemodal').click(function() {
            $('#ajaxModel').modal('hide');
        });
    </script>
@endsection

@extends('layouts.libaryapp')
@section('title', 'Book Issue Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Book Issue</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
                                </span>
                            </li>
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-primary" href="{{ url('/book_issue_pdf') }}" id=""> Download PDF
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
                                                <th>Card No.</th>
                                                <th>Book Name</th>
                                                <th>Number of Books</th>
                                                <th>Author</th>
                                                <th>Date of Issue Books</th>
                                                <th>Date of Return Books</th>
                                                <th>Publication</th>
                                                <th>Edition</th>
                                                <th>Volumn</th>
                                                <th>Accession Number</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                @php
                                                    $cardName = DB::table('library_cards')
                                                        ->where('id', $ndata->card_no)
                                                        ->first();
                                                    $bookName = DB::table('bookstocks')
                                                        ->where('id', $ndata->book_id)
                                                        ->first();
                                                @endphp
                                                {{-- @dd($ndata); --}}
                                                <tr>

                                                    <td>{{ $cardName ? $cardName->card_no : '' }}</td>
                                                    <td>{{ $bookName ? $bookName->book_name : '' }}</td>
                                                    <td>{{ $ndata->number_of_book }}</td>
                                                    <td>{{ $ndata->author }} </td>
                                                    <td>{{ $ndata->date_of_issue_book }} </td>
                                                    <td>{{ $ndata->date_of_return_book }} </td>
                                                    <td>{{ $bookName ? $bookName->publiction : '' }}</td>
                                                    <td>{{ $bookName ? $bookName->edition : '' }}</td>
                                                    <td>{{ $bookName ? $bookName->volumn : '' }}</td>
                                                    <td>{{ $bookName ? $bookName->accession_number : '' }}</td>
                                                    <td><button type="button" id="edit" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-info"><span
                                                                class="glyphicon glyphicon-edit"></span></button>
                                                        <button type="button" id="delete" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-danger"><span
                                                                class="glyphicon glyphicon-trash"></span></button>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="ajaxModel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" name="form" class="form-horizontal"
                                        action="{{ route('bookissue.store') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="card_no" class="col-sm-12 control-label">Library Card No.</label>
                                            <div class="col-sm-12">
                                                <select class="js-select2" name="card_no" id="card_no" required>
                                                    <option class="" value="" selected>--Select Library Card No.
                                                        --</option>
                                                    @foreach ($Card as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->card_no }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <span class="text-danger">
                                                @error('card_no')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Book Name</label>
                                            <div class="col-sm-12">
                                                <select class="js-select2" name="book_name" id="book_name" required>
                                                    <option class="" value="" selected>--Select Book Name
                                                        --</option>
                                                    @foreach ($data1 as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->book_name }}--{{ $item->author }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="text-danger">
                                                @error('book_name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label for="text" class="col-sm-12 control-label">Author</label>
                                            <div class="col-sm-12"> <select class="form-control author" name="author"
                                                    id="author" required>
                                                    <option class="" value="" selected>--Select Author--
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="text" class="col-sm-12 control-label">Number Of Books</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" id="number_of_book"
                                                    name="number_of_book" placeholder="Enter Number Of Book"
                                                    value="" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="date_of_issue_book" class="col-sm-12 control-label">Date Of Issue
                                                Books</label>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control" id="date_of_issue_book"
                                                    name="date_of_issue_book" placeholder="Enter Date Of Issue Books"
                                                    value="" required="">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="date_of_return_book" class="col-sm-12 control-label">Date Of
                                                Return Books</label>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control" id="date_of_return_book"
                                                    name="date_of_return_book" placeholder="Enter Date Of Return Books"
                                                    value="" required="">

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
            $.get("{{ route('bookissue.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#card_no').val(data.card_no).trigger('change');
                $('#book_name').val(data.book_id).trigger('change');
                $('#author').val(data.author).trigger('change');
                $('#number_of_book').val(data.number_of_book);
                $('#number_of_remaining_book').val(data.number_of_remaining_book);
                $('#date_of_issue_book').val(data.date_of_issue_book);
                $('#date_of_return_book').val(data.date_of_return_book);

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
                        url: 'bookissue/' + id,
                        success: function(data) {
                            window.location = 'bookissue';
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
    <script>
        $(document).ready(function() {
            $('#card_no').select2({
                placeholder: "--Select--",
                allowClear: true,
                width: '100%'
            });
            $('#book_name').select2({
                placeholder: "--Select--",
                allowClear: true,
                width: '100%'
            });

            $('#book_name').on('change', function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: 'bookID/' + id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // console.table([data]);
                            $('#author').empty();
                            $('#author').append('<option value="">--Select--</option>');
                            $.each(data, function(key, value) {
                                $('#author').append('<option data_value ="' + value
                                    .number_of_copies + '" value="' + value.author +
                                    '">' + value.author + '</option>');
                            });
                            $('#author').trigger('change');

                        }
                    });
                }
            });
            // $('#number_of_book').on('keyup', function() {
            //     var numberOfBook = $(this).val();
            //     var numberOfCopies = parseFloat($('#author option:selected').attr('data_value'));

            //     $('#number_of_remaining_book').val(numberOfCopies - numberOfBook);
            // });
        });
    </script>
@endsection

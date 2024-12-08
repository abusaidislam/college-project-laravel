@extends('layouts.department')
@section('title', 'Seminar Book Refund with Fine Manage |')
@section('content')
<div class="content">
      <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Book Refund with Fine</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                     <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
                                 </span>
                              </li>
                              <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-primary" href="{{ url('/seminar_book_refund_pdf') }}" id="">
                                        Download PDF </a>
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
                                                <th>Student Name</th>
                                                <th>Card No.</th>
                                                <th>Book Name</th>
                                                <th>Accession Number</th>
                                                <th>Number of Book</th>
                                                <th>Author</th>
                                                <th>Date of Return</th>
                                                <th>Date of Due</th>
                                                <th>Late Fine Amount(TK)</th>
                                                <th>Book Condition</th>
                                                <th>Comments</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($datareturnd as $ndata)
                                                @php

                                                    $cardNumber = DB::table('seminar_library_cards')
                                                        ->where('id', $ndata->card_id)
                                                        ->first();
                                                    $bookName = DB::table('seminar_book_stocks')
                                                        ->where('id', $ndata->book_id)
                                                        ->first();

                                                @endphp
                                                <tr>
                                                    <td>{{ $cardNumber ? $cardNumber->student_name : '' }} </td>
                                                    <td>{{ $cardNumber ? $cardNumber->card_no : '' }} </td>
                                                    <td>{{ $bookName ? $bookName->book_name : '' }}</td>
                                                    <td>{{ $bookName ? $bookName->accession_number : '' }}</td>
                                                    <td>{{ $ndata->numberofbook }}</td>
                                                    <td>{{ $ndata->author_name }}</td>
                                                    <td>{{ $ndata->date_of_return }}</td>
                                                    <td>{{ $ndata->due_date }}</td>
                                                    <td>{{ $ndata->late_fine ?? 'No fine' }}</td>
                                                    <td>{{ $ndata->book_condition }}</td>
                                                    <td>{!! $ndata->comments !!} </td>

                                                    <td class="action-column"><button type="button" id="edit"
                                                            data-id="{{ $ndata->id }}" class="btn btn-sm btn-info">Edit</button>
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
                                        action="{{ route('seminar-book-refund.store') }}" enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="id" id="id">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="card_id" class="col-sm-12 control-label">Library Card No.</label>
                                                    <div class="col-sm-12">
                                                        <select class="js-select2" name="card_id" id="card_id">
                                                            <option class="" value="0" selected>--Select Library Card No.
                                                                --</option>
                                                            @php
                                                                $uniqueCardNos = DB::table('seminar_book_issues')
                                                                    ->distinct()
                                                                    ->pluck('card_no');
                                                            @endphp

                                                            @foreach ($uniqueCardNos as $cardNo)
                                                                @php
                                                                    $cardInfo = DB::table('seminar_library_cards')
                                                                        ->where('id', $cardNo)
                                                                        ->first();
                                                                @endphp
                                                                @if ($cardInfo)
                                                                    <option value="{{ $cardInfo->id }}">{{ $cardInfo->card_no }}
                                                                    </option>
                                                                @endif
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="book_id" class="col-sm-12 control-label">Book Name</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control" name="book_id" id="book_id">
                                                            <option class="" value="0" selected>--Select Book Name
                                                                --</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="author_name" class="col-sm-12 control-label">Author</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="author_name"
                                                            name="author_name" placeholder="Author Name" value=""
                                                            required="" readonly>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="NumberOfBook" class="col-sm-12 control-label">Return Number of
                                                        Book</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="numberofbook"
                                                            name="numberofbook" placeholder="Number Of Book" value=""
                                                            required="">

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="date_of_return" class="col-sm-12 control-label">Date Of
                                                        Return Books</label>
                                                    <div class="col-sm-12">
                                                        <input type="date" class="form-control" id="date_of_return"
                                                            name="date_of_return" placeholder="Date Of Return Books"
                                                            value="" required="" readonly>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="late_date_of_return_book" class="col-sm-12 control-label">Late
                                                        Date
                                                        Of
                                                        Return Books</label>
                                                    <div class="col-sm-12">
                                                        <input type="date" class="form-control" id="late_date_of_return_book"
                                                            name="late_date_of_return_book"
                                                            placeholder="Enter Current Date Of Return Books" value=""
                                                            required="">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                          
                                                <div class="form-group">
                                                    <label for="late_fine" class="col-sm-12 control-label">Late_Fine</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="late_fine"
                                                            name="late_fine" placeholder="" value="">

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="col-sm-12 control-label">Book Condition</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control  " name="book_condition" id="book_condition">
                                                            <option class="" value="0" selected>--Select Book Condition
                                                                --</option>
                                                            <option value="Good">Good</option>
                                                            <option value="Damaged">Damaged</option>
                                                            <option value="missing Pages">missing Pages</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="col-sm-12 control-label">Comment:</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="summernote" placeholder="Enter Details" id="comment"name="comment" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" col-sm-offset-2 col-sm-10 my-2">
                                            <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                            <button type="button" class="btn btn-danger" id="closemodal" aria-label="Close">
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
            $.get("{{ route('seminar-book-refund.index') }}" + '/' + id + '/edit', function(data) {
                // console.log(data);
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#card_id').val(data.card_id).trigger('change');
                $('#book_id').val(data.book_id).trigger('change');
                $('#author_name').val(data.author_name);
                $('#date_of_return').val(data.date_of_return);
                $('#late_date_of_return_book').val(data.due_date);
                $('#late_fine').val(data.late_fine);
                $('#book_condition').val(data.book_condition);
                $('#comment').val(data.comments);

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
                        url: 'seminar-book-refund/' + id,
                        success: function(data) {
                            window.location = 'seminar-book-refund';
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
            $('#card_id').select2({
                placeholder: "--Select--",
                allowClear: true,
                width: '100%'
            });
            // $('#book_id').select2({
            //     placeholder: "--Select--",
            //     allowClear: true,
            //     width: '100%'
            // });

            $('#card_id').on('change', function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: 'seminarbookName/' + id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#book_id').empty();
                            $('#book_id').append('<option value="">--Select--</option>');

                            $.each(data, function(key, value) {
                                $('#book_id').append('<option numberofbook ="' + value
                                    .number_of_book + '" return_date ="' + value
                                    .date_of_return_book + '" author_value ="' +
                                    value
                                    .author + '" value="' + value.book_id +
                                    '">' + value.book_name + '</option>');

                            });
                            $('#book_id').trigger('change');

                        }
                    });
                }
            });
            $('#book_id').on('change', function() {
                var AuthorName = $('#book_id option:selected').attr('author_value');
                var ReturnDate = $('#book_id option:selected').attr('return_date');
                var numberofbook = $('#book_id option:selected').attr('numberofbook');
                $('#author_name').val(AuthorName).css('color', 'green');
                $('#date_of_return').val(ReturnDate).css('color', 'green');
                $('#numberofbook').val(numberofbook).css('color', 'green');
            });
            $('#late_date_of_return_book').on('change', function() {
                var lateDate = $(this).val();
                var ReturnDate = $('#book_id option:selected').attr('return_date');
                var finedate = lateDate > ReturnDate;
                var placeholderText = finedate ? "Fine Amount (in taka)" : "No Fine";
                var placeholderColor = finedate ? 'red' : 'green';

                $('#late_fine')
                    .attr('placeholder', placeholderText)
                    .css('::placeholder', 'color: ' + placeholderColor);

            });

        });
    </script>
@endsection

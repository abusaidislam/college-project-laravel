@extends('layouts.libaryapp')
@section('title', 'No Return Book |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 pt-4">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>No Return Book</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            {{-- <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
                                </span>
                            </li> --}}
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-primary" href="{{ url('/book_no_return_pdf') }}" id=""> Download PDF </a>
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
                                                <th>Name</th>
                                                <th>Book Name</th>
                                                <th>Accession Number</th>
                                                <th>Date of Issue Books</th>
                                                <th>Date of Return Books</th>
                                                <th>Late Day</th>
                                                <th>Number of Books</th>
                                                <th>Author</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($unmatchedData as $ndata)
                                                @php
                                                    $cardName = DB::table('library_cards')
                                                        ->where('id', $ndata->card_no)
                                                        ->first();
                                                    $bookName = DB::table('bookstocks')
                                                        ->where('id', $ndata->book_id)
                                                        ->first();

                                                    $currentDate = \Carbon\Carbon::now();
                                                    $returnDate = \Carbon\Carbon::parse($ndata->date_of_return_book);

                                                    if ($currentDate > $returnDate) {
                                                        $lateDays = $currentDate->diffInDays($returnDate) . ' ' . 'Days Late';
                                                    } else {
                                                        $lateDays = '';
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>{{ $cardName ? $cardName->card_no : '' }} </td>
                                                    <td>{{ $cardName ? $cardName->student_name : '' }} </td>
                                                    <td>{{ $bookName? $bookName->book_name : '' }}</td>
                                                    <td>{{ $bookName? $bookName->accession_number : '' }}</td>
                                                    <td>{{ $ndata->date_of_issue_book }} </td>
                                                    <td>{{ $ndata->date_of_return_book }} </td>
                                                    <td style="color: red">{{ $lateDays }}
                                                    </td>
                                                    <td>{{ $ndata->number_of_book }}</td>
                                                    <td>{{ $ndata->author }} </td>
                                                    <td>

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
                console.log(data);
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
                        url: 'book_no_retrn/' + id,
                        success: function(data) {
                            window.location = 'book_no_retrn';
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

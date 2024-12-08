<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<title>Book Issue Report</title>

<head>
    <style>
        @font-face {
            font-family: "kalpurush";
            font-style: normal;
            font-weight: normal;
            src: url(vendor/dompdf/kalpurush.ttf) format('truetype');
        }

        * {
            font-family: "kalpurush";
            /* font-size: 12px; */
        }


        /* Style for the table */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
            font-size: 12px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th {
            text-align: center;
        }

        .eliment {
            text-align: center;
        }

        td {
            padding: 2px;
            text-align: left;
        }

        /* Style for table header (thead) */
        thead {
            background-color: #f2f2f2;
        }

        /* Style for table header cells (th) */
        th {
            background-color: #4CAF50;
            color: white;
        }

        /* Style for table row on hover */
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <div class="card-box table-responsive">
        <center>
            <h2><strong>Government Saadat College</strong><br>
                Karatia, Tangail<br>
                Book Issue Report
            </h2>
        </center>
        <hr>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
            width="100%">
            <thead>
                <tr>
                    <th>Card No.</th>
                    <th>Book Name</th>
                    <th>Number of Books</th>
                    <th>Number of Remaining Books</th>
                    <th>Date of Issue Books</th>
                    <th>Date of Return Books</th>
                    <th>Author</th>
                    <th>Publication</th>
                    <th>Edition</th>
                    <th>Volumn</th>
                    <th>Accession Number</th>
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
                        <td class="eliment">{{ $cardName?$cardName->card_no:'' }}</td>
                        <td>{{ $bookName?$bookName->book_name:'' }}</td>
                        <td class="eliment">{{ $ndata->number_of_book }}</td>
                        <td class="eliment">{{ $ndata->number_of_remaining_book }}</td>
                        <td>{{ $ndata->author }} </td>
                        <td>{{ $ndata->date_of_issue_book }} </td>
                        <td>{{ $ndata->date_of_return_book }} </td>
                        <td>{{$bookName?$bookName->publiction:'' }}</td>
                        <td>{{$bookName?$bookName->edition:'' }}</td>
                        <td class="eliment">{{$bookName?$bookName->volumn:'' }}</td>
                        <td class="eliment">{{$bookName?$bookName->accession_number:'' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</body>

</html>

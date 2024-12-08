<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Seminar Book No Return List</title>
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
                {{ $depart_name ?? '' }}<br>
                Seminar Book No Return List
            </h2>
        </center>
        <hr>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
            width="100%">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Card No.</th>
                    <th>Book Name</th>
                    <th>Date of Issue Books</th>
                    <th>Date of Return Books</th>
                    <th>Late Day</th>
                    <th>Number of Books</th>
                    <th>Author</th>
                </tr>
            </thead>
            <tbody id="list">
                @foreach ($data as $ndata)
                    @php
                        $cardName = DB::table('seminar_library_cards')
                            ->where('id', $ndata->card_no)
                            ->first();
                        $bookName = DB::table('seminar_book_stocks')
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
                        <td>{{ $cardName ? $cardName->student_name : '' }} </td>
                        <td class="eliment">{{ $cardName ? $cardName->card_no : '' }} </td>
                        <td>{{ $bookName ? $bookName->book_name : '' }}</td>
                        <td>{{ $ndata->date_of_issue_book }} </td>
                        <td>{{ $ndata->date_of_return_book }} </td>
                        <td style="color: red">{{ $lateDays }}
                        </td>
                        <td class="eliment">{{ $ndata->number_of_book }}</td>
                        <td>{{ $ndata->author }} </td>

                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</body>

</html>

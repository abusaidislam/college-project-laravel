<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Book Stock Report</title>
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
                Book Stock Report
            </h2>
        </center>
        <hr>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
            width="100%">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Author</th>
                    <th>Book Name</th>
                    <th>Publication</th>
                    <th>Edition</th>
                    <th>Number Of Copies</th>
                    <th>Volumn</th>
                    <th>Purchase Date</th>
                    <th>Accession Number</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="list">
                @foreach ($data as $ndata)
                    <tr>
                        <td><img src="{{ asset('public/library_book/' . $ndata->photo) }}" alt="" width="80"
                                height="80"></td>
                        <td>{{ $ndata->author }} </td>
                        <td>{{ $ndata->book_name }}</td>
                        <td>{{ $ndata->publiction }} </td>
                        <td class="eliment">{{ $ndata->edition }} </td>
                        <td class="eliment">{{ $ndata->number_of_copies }}</td>
                        <td class="eliment">{{ $ndata->volumn }} </td>
                        <td>{{ $ndata->date }} </td>
                        <td class="eliment">{{ $ndata->accession_number }} </td>
                        <td class="eliment">{{ $ndata->price }} </td>
                        <td>{{ $ndata->status == 1 ? 'Active' : 'InActive' }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>


    </div>
</body>

</html>

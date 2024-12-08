
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="{{ asset('public/adminasset/plugins/fontawesome-free/css/all.min.css') }}">

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('public/adminasset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link
    rel="stylesheet"href="{{ asset('public/adminasset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/adminasset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/adminasset/dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/adminasset/plugins/sweetalert2/sweetalert2.min.css') }}">

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('public/adminasset/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/adminasset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

<link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">

<link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="{{ asset('public/adminasset/jquery-3.6.0.min.js') }}"></script>

<script>
    const sweetAlertConfirmation = {
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    };
    const toastConfiguration = {
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    };
</script>

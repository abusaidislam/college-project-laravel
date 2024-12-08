<!-- Favicon -->
<link href="{{ asset('public/basic/favicon.ico') }}" rel="icon">





<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="{{ asset('frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
<!-- <link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet"> -->

<!-- Customized Bootstrap Stylesheet -->
<link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- Template Stylesheet -->
<link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


{{-- new --}}
<link rel="stylesheet" href="{{ asset('public/adminasset/plugins/sweetalert2/sweetalert2.min.css') }}">

{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('public/adminasset/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/adminasset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
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
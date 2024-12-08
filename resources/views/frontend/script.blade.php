    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('public/adminasset/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('frontend/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>

    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>


    <!-- Initialize Swiper -->

    <!-- Template Javascript -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    {{-- <script src="{{ asset('build/js/custom.min.js') }}"></script> --}}
    {{-- new --}}

    {{-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
   <script>
        new DataTable('#example', {
            responsive: true
        });

        $(document).ready(function() {
        // for saveBtn Disabled
        $('#form').submit(function(event) {
            if ($(this).data('isSubmitting')) {
                event.preventDefault();
                return;
            }
            $(this).data('isSubmitting', true);
            $('#saveBtn').prop('disabled', true);
            return true;
        });

        // for Sweet Alert message
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        @if (Session::has('message'))
            Toast.fire({
                icon: 'success',
                title: '{{ Session::get('message') }}',
            });
        @endif
        @if (Session::has('error'))
            Toast.fire({
                icon: 'error',
                title: '{{ Session::get('error') }}',
            });
        @endif
    });
    </script>

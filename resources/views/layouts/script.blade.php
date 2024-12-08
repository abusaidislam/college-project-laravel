<script src="{{ asset('public/adminasset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/adminasset/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('public/adminasset/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
<script src="{{ asset('vendors/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ asset('vendors/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendors/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('build/js/custom.min.js') }}"></script>


<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
{{-- <link href="{{ asset('public/adminasset/summernote/summernote-bs4.min.css') }}" rel="stylesheet">
<script src="{{ asset('public/adminasset/summernote/summernote-bs4.min.js') }}"></script> --}}
{{-- <script src="{{ asset('public/adminasset/select2.min.js') }}"></script> --}}
<script src="{{ asset('vendors/jspdf_html2pdf_download.js') }}"></script>



<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
            placeholder: ''
        });

    });
</script>
<script>
    // for sidebar menu height auto
    document.addEventListener('DOMContentLoaded', function() {
        adjustSidebarHeight();
        window.addEventListener('resize', adjustSidebarHeight);
    });

    function adjustSidebarHeight() {
        var mainSidebar = document.getElementById('mainSidebar');
        var windowHeight = window.innerHeight;
        var headerHeight = document.querySelector('.main-header').offsetHeight;
        var newHeight = windowHeight - headerHeight + 'px';
        mainSidebar.style.height = newHeight;
    }

    // for sidebar menu active class
    var currentUrl = window.location.href;
    $('.nav-item a[href="' + currentUrl + '"]').addClass('active');
    $('.nav-item a').on('click', function() {
        $('.nav-item a').removeClass('active');
        $(this).addClass('active');
    });
    var url = window.location;
    // for sidebar menu entierly but ont cover treeview
    $('ul .nav-sidebar a').filter(function() {
        if (this.href) {
            return this.href == url || url.href.indexOf(this.href) == 0;
        }
    }).addClass('active');
    // for treeview
    $('ul .nav-treeview a').filter(function() {
        if (this.href) {
            return this.href == url || url.href.indexOf(this.href) == 0;
        }
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');


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
            timer: 2500,
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

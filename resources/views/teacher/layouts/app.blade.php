<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SkillNest') }} | Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Plugins css -->
    <link href="{{ asset('atportal/assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('atportal/assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('atportal/assets/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('atportal/assets/libs/multiselect/css/multi-select.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('atportal/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('atportal/assets/libs/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('atportal/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('atportal/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('atportal/assets/libs/clockpicker/bootstrap-clockpicker.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('atportal/assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('atportal/assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('atportal/assets/libs/busyload/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('atportal/assets/libs/auto-complete/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('atportal/assets/libs/ladda/ladda-themeless.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- third party css -->
    <link href="{{ asset('atportal/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('atportal/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('atportal/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('atportal/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- third party css end -->


    <!-- App css -->
    <link href="{{ asset('atportal/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{ asset('atportal/assets/css/app.min.css') }}" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />

    <link href="{{ asset('atportal/assets/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-dark-stylesheet" disabled />
    <link href="{{ asset('atportal/assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="app-dark-stylesheet" disabled />

    <!-- icons -->
    <link href="{{ asset('atportal/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <style media="screen">
        .ui-widget-content {
            z-index: 99999;
        }

        .form-control:disabled,
        .form-control[readonly] {
            background-color: #f3f3f3;
        }

        .pro-user-name {
            color: #fff;
        }

        .zoomable-img {
            transition: all .2s linear;
        }

        .zoomable-img:hover {
            transform: scale(4);
        }

        .datepicker-dropdown {
            z-index: 10000 !important;
        }
    </style>


    @yield('css')
</head>

<body
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
    <!-- Begin page -->
    <div id="wrapper">
        @include('admin.layouts.header')
        @include('admin.layouts.sidebar')

        @yield('content')
    </div>
    <!-- END wrapper -->

    <!-- Vendor js -->
    <script src="{{ asset('atportal/assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/mohithg-switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/jquery-mockjax/jquery.mockjax.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/clockpicker/bootstrap-clockpicker.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/busyload/app.min.js') }}"></script>

    <!-- third party js -->
    <script src="{{ asset('atportal/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('atportal/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/ajax-form/jquery.form.min.js') }}"></script>
    <!-- third party js ends -->

    <!-- Plugins js-->
    <script src="{{ asset('atportal/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('atportal/assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/auto-complete/jquery-ui.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/ladda/spin.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/libs/ladda/ladda.min.js') }}"></script>

    <!-- App js-->
    <script src="{{ asset('atportal/assets/js/is.min.js') }}"></script>
    <script src="{{ asset('atportal/assets/js/app.min.js') }}"></script>
    <!-- push custom script & js -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
    </script>

    @yield('js')
</body>

</html>

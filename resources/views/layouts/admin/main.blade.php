<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('headerTitle', 'Home') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('admin-assets/images/logo/favicon.png') }}">

    <!-- plugins css -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/PACE/themes/blue/pace-theme-minimal.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/perfect-scrollbar/css/perfect-scrollbar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/selectize/dist/css/selectize.default.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/summernote/dist/summernote.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-daterangepicker/daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/summernote/dist/summernote.css') }}" />

    <!-- page plugins css -->
    <link rel="stylesheet" href="{{ asset('vendor/bower-jvectormap/jquery-jvectormap-1.2.2.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/nvd3/build/nv.d3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/datatables/media/css/jquery.dataTables.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" />
    

    <!-- core css -->
    <link href="{{ asset('admin-assets/css/ei-icon.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="app header-white">
        <div class="layout">
            @include('layouts.admin.left-menu')

            <!-- Page Container START -->
            @include('layouts.admin.header-menu')
            <!-- Page Container END -->

        </div>
    </div>
    
    <!-- Modal START-->
    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Are you Sure to Delete?</h4>
                </div>
                <div class="modal-footer no-border">
                    <div class="text-right">
                        <button class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary btn-sm" onclick="deleteRecord()">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/vendor.js') }}"></script>

    <!-- page plugins js -->
    <script src="{{ asset('vendor/bower-jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/maps/jquery-jvectormap-us-aea.js') }}"></script>
    <script src="{{ asset('vendor/d3/d3.min.js') }}"></script>
    <script src="{{ asset('vendor/selectize/dist/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('vendor/nvd3/build/nv.d3.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery.sparkline/index.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('vendor/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('vendor/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('vendor/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/app.min.js') }}"></script>

    <!-- page js -->
    <script src="{{ asset('vendor/datatables/media/js/jquery.dataTables.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    
    @stack('script')

</body>

</html>
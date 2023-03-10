<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ env('APP_NAME') }} username</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('js/custom/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-1enE6GKb+39w7x+c8f6HLm9XaYRfLcT6TnT/8Mq3lrqj2wNucMQ/KsTcnNqLoXZq2Q1C0/+8OfKyyeHuAzoPsw==" crossorigin="anonymous" /> --}}

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/custom/css/sb-admin-2.min.css') }}" rel="stylesheet">

    @yield('extraLinks')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">





        @if (Auth::user()->role == 'Admin')
            @include('layouts.custom.sidebar')
        @else
            @include('layouts.custom.sidebar_staff')
        @endif



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layouts.custom.navigations')


                @yield('page_content')


            </div>
            <!-- End of Main Content -->

            @include('layouts.custom.footer')


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('layouts.custom.modals')


    @include('layouts.custom.js_scripts')


</body>

</html>

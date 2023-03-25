@extends('layouts.custom.app')

@section('extraLinks')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        #SelExample {
            width: 200px;
        }
    </style>
    <!-- Load Select2 from a CDN or include the Select2 library in your project -->
    <link href="{{ asset('css/custom/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
@endsection

@section('page_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Welcome, {{Auth::user()->name}}! <a href=""></a></h1>

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-12">
                        <div class="p-5">

                            <form action="{{ url('dashboard/laundry/orders/view/') }}" method="POST" class="users">
                                @csrf

                                <div class="form-group">
                                    <label for="status">Select or Search Order:</label>
                                    <select id="mySelect" class="form-control" id="status" name="order_number">
                                        @foreach ($laundries as $laundry)
                                            <option value="{{ $laundry->order_number }}">{{ $laundry->order_number }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                <button type="submit" class="btn btn-primary">View Order</button>
                            </form>

                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection




@section('extraJS')
    <!-- Load jQuery and Select2 JavaScript libraries from a CDN or include them in your project -->

    <script src="{{ asset('css/custom/select2/dist/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#mySelect').select2();
        });
    </script>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(function() {
            $('#datepicker').datepicker({
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>



   
   
@endsection

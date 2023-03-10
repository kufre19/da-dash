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
        <h1 class="h3 mb-4 text-gray-800">Add New Laundry Order</h1>

    </div>
    <!-- /.container-fluid -->

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-12">
                    <div class="p-5">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        {{-- this is to alert changes for basket --}}
                        <div class="alert alert-dismissible fade hide basket_alert " role="alert">
                            <p id="basket_alert_message"></p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {{-- end of the alert --}}

                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">New Laundry Order For:</h1>
                        </div>
                        <form action="{{url('dashboard/laundry/basket/gallery/upload')}}" method="POST" enctype="multipart/form-data" class="user">
                            @csrf

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="mySelect">Order Number:</label>


                                    <select id="mySelect" name="order_number" class=" form-control ">


                                        @foreach ($orders as $order)
                                            <option value="{{ $order->order_number }}">{{ $order->order_number }}
                                            </option>
                                        @endforeach
                                    </select>




                                </div>

                                <div class="col-sm-6 mb-3 mb-sm-0">

                                    <label for="cost">Uplaod Images</label>
                                    <input type="file" name="images[]" accept="image/*" id="cost" class="form-control" multiple="true" required>
                                </div>
                            </div>

                            <hr>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Upload Images For This Order
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
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




    {{-- when form is submitted  --}}
@endsection

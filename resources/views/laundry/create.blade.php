@extends('layouts.custom.app')

@section('extraLinks')
    <style>
        #SelExample {
            width: 200px;
        }
    </style>
    <!-- Load Select2 from a CDN or include the Select2 library in your project -->
    <link href="{{ asset('css/custom/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection

@section('page_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Add New New Laundry Order</h1>

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
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">New Laundry Order For:</h1>
                        </div>
                        <form action="{{ url('/dashboard/laundry/create') }}" method="POST" class="user">
                            @csrf

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="mySelect">Customer</label>

                                    <select id="mySelect" class=" form-control ">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}
                                                ({{ $customer->phone }})
                                            </option>
                                        @endforeach
                                    </select>




                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="datepicker">Date</label>

                                    <div class="input-group date">
                                        <input type="text" class="form-control" id="datepicker">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>



                                </div>
                            </div>





                        </form>

                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-12">
                    <div class="p-5">



                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">

                                <textarea name="description" class="form-control" id="" cols="30" rows="10"
                                    placeholder="Description"></textarea>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="border p-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="radioSelection" id="option1"
                                                    value="option1" checked>
                                                <label class="form-check-label" for="option1">
                                                    <i class="fas fa-tshirt"></i> T-Shirt
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="radioSelection" id="option2"
                                                    value="option2">
                                                <label class="form-check-label" for="option2">
                                                    <i class="fas fa-socks"></i> Socks
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="radioSelection" id="option3"
                                                    value="option3">
                                                <label class="form-check-label" for="option3">
                                                    <i class="fas fa-hat-cowboy"></i> Hat
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="radioSelection" id="option4"
                                                    value="option4">
                                                <label class="form-check-label" for="option4">
                                                    <i class="fas fa-shoe-prints"></i> Shoes
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="radioSelection" id="option5"
                                                    value="option5">
                                                <label class="form-check-label" for="option5">
                                                    <i class="fas fa-glasses"></i> Glasses
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="radioSelection" id="option6"
                                                    value="option6">
                                                <label class="form-check-label" for="option6">
                                                    <i class="fas fa-umbrella"></i> Umbrella
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Create Laundry Order
                        </button>
                        <hr>

                        </form>

                        <hr>
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
    <script>
        $(function() {
            $('#datepicker').datepicker({
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
@endsection

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
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
                        <form action="{{ url('/dashboard/laundry/create') }}" method="POST" id="laundry_form"
                            class="user">
                            @csrf

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="mySelect">Customer</label>

                                    <select id="mySelect" name="customer" class=" form-control ">
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
                                    placeholder="Description (optional)"></textarea>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="border p-3">

                                    <!-- Laundry selection form -->
                                    <div class="laundry-selection-form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry-type" value="pants">
                                                    <img src="https://static.thenounproject.com/png/1505542-200.png"
                                                        alt="Pants icon" style="width: 32px; height: 32px;">
                                                    <span>Pants</span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry-type" value="knickers">
                                                    <img src="https://static.thenounproject.com/attribution/1203658-600.png"
                                                        alt="Knickers icon" style="width: 32px; height: 32px;">
                                                    <span>Knickers</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry-type" value="bra">
                                                    <img src="https://static.thenounproject.com/attribution/5557174-600.png"
                                                        alt="Bra icon" style="width: 32px; height: 32px;">
                                                    <span>Bra</span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry-type" value="shirt">
                                                    <img src="https://static.thenounproject.com/attribution/1605025-600.png"
                                                        alt="Shirt icon" style="width: 32px; height: 32px;">
                                                    <span>Shirt</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry-type" value="socks">
                                                    <img src="https://static.thenounproject.com/attribution/5557074-600.png"
                                                        alt="Socks icon" style="width: 32px; height: 32px;">
                                                    <span>Socks</span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry-type" value="underwear">
                                                    <img src="https://static.thenounproject.com/attribution/3560200-600.png"
                                                        alt="Underwear icon" style="width: 32px; height: 32px;">
                                                    <span>Underwear</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry-type" value="wedding_dress">
                                                    <img src="https://static.thenounproject.com/attribution/1179049-600.png"
                                                        alt="Wedding icon" style="width: 32px; height: 32px;">
                                                    <span>Wedding Dress</span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry-type" value="suit">
                                                    <img src="https://static.thenounproject.com/attribution/1964510-600.png"
                                                        alt="Suits icon" style="width: 32px; height: 32px;">
                                                    <span>Suits</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry-type" value="Sleeve">
                                                    <img src="https://static.thenounproject.com/attribution/4132187-600.png"
                                                        alt="Sleeve icon" style="width: 32px; height: 32px;">
                                                    <span> Sleeve</span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry-type" value="Sweater">
                                                    <img src="https://static.thenounproject.com/attribution/1607917-600.png"
                                                        alt="Sweater icon" style="width: 32px; height: 32px;">
                                                    <span>Sweater</span>
                                                </label>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry-type" value="Complete">
                                                    <img src="https://static.thenounproject.com/attribution/178364-600.png"
                                                        alt="Complete icon" style="width: 32px; height: 32px;">
                                                    <span> Complete</span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry-type" value="Bedding">
                                                    <img src="https://static.thenounproject.com/attribution/5555943-600.png"
                                                        alt="Bedding icon" style="width: 32px; height: 32px;">
                                                    <span>Bedding</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry-type" value="Towel">
                                                    <img src="https://static.thenounproject.com/attribution/5550494-600.png"
                                                        alt="Towel icon" style="width: 32px; height: 32px;">
                                                    <span> Towel</span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry-type" value="Blanket">
                                                    <img src="https://static.thenounproject.com/attribution/4603776-600.png"
                                                        alt="Blanket icon" style="width: 32px; height: 32px;">
                                                    <span>Blanket</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry-type" value="Skirt">
                                                    <img src="https://static.thenounproject.com/attribution/2742585-600.png"
                                                        alt="Skirt icon" style="width: 32px; height: 32px;">
                                                    <span> Skirt</span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry-type" value="Curtain">
                                                    <img src="https://static.thenounproject.com/attribution/1544435-600.png"
                                                        alt="Curtain icon" style="width: 32px; height: 32px;">
                                                    <span>Curtain</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>



                        </div>


                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">

                                <label for="qty">Quantity</label>
                                <input type="number" name="quantity" id="qty" class="form-control"
                                    placeholder="number of materials">
                            </div>

                            <div class="col-sm-6 mb-3 mb-sm-0">

                                <label for="cost">Cost</label>
                                <input type="text" name="cost" id="cost" class="form-control"
                                    placeholder="Cost For Laundry">
                            </div>




                        </div>


                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Create Laundry Order
                        </button>
                        <hr>

                        </form>


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
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Laundry Basket:</h1>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Laundry Type</th>
                                    <th>Description</th>
                                    <th>Cost</th>
                                    <th>Qty</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Pants</td>
                                    <td>Black cotton pants</td>
                                    <td>$5.00</td>
                                    <td>2</td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shirt</td>
                                    <td>White dress shirt</td>
                                    <td>$3.50</td>
                                    <td>1</td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Socks</td>
                                    <td>Gray wool socks</td>
                                    <td>$1.75</td>
                                    <td>5</td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>






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



    {{-- when form is submitted  --}}
    <script>
        $(document).ready(function() {
            $("#laundry_form").submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize(); // serialize the form data
                $.ajax({
                    url: "{{url('dashboard/laundry/basket/add')}}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        // add the submitted data to the table
                        var tableRow = "<tr>" +
                            "<td>" + response.laundry_type + "</td>" +
                            "<td>" + response.date + "</td>" +
                            "<td>" + response.cost + "</td>" +
                            "<td>" + response.description + "</td>" +
                            "<td>" + response.qty + "</td>" +
                            "<td><button class='btn btn-danger delete-btn'>Delete</button></td>" +
                            "</tr>";
                        $("#laundry-table tbody").append(tableRow);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log("Error: " + errorThrown);
                    }
                });
            });

            // handle delete button click event
            $("#laundry-table tbody").on("click", ".delete-btn", function() {
                $(this).closest("tr").remove();
            });
        });
    </script>
@endsection

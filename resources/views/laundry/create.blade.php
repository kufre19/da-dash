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
                        <form id="laundry_form" class="user">

                            @csrf

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="mySelect">Customer</label>


                                    <select id="mySelect" name="customer" class=" form-control ">

                                        @if (session()->has('laundry_order_info'))
                                            @if (session()->get('laundry_order_info')['customer'] != '')
                                                <option value="{{ session()->get('laundry_order_info')['customer'] }}"
                                                    selected></option>
                                            @endif
                                        @endif
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
                                        @if (session()->has('laundry_order_info'))
                                            @if (session()->get('laundry_order_info')['laundry_date'] != '')
                                                <input type="text" name="laundry_date" class="form-control"
                                                    value="{{ session()->get('laundry_order_info')['laundry_date'] }}"
                                                    id="datepicker" autocomplete="off">
                                            @else
                                                <input type="text" name="laundry_date" class="form-control"
                                                    id="datepicker" autocomplete="off">
                                            @endif
                                        @else
                                            <input type="text" name="laundry_date" class="form-control" id="datepicker">
                                        @endif
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>



                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="payment_status">Select Payment Status</label>

                                    <select  name="payment_status" class=" form-control " required>
                                        @if (session()->has('laundry_order_info'))
                                        @if (session()->get('laundry_order_info')['payment_status'] != '')
                                        <option value="{{session()->get('laundry_order_info')['payment_status']}}" selected>Select Payment Status</option>
                                        @endif
                                        @endif
                                        <option disabled>Select Payment Status</option>

                                        <option value="Paid">Paid</option>
                                        <option value="Unpaid">Unpaid</option>
                                        {{-- <option value="ATM Card">Deposit Made</option> --}}
                                    </select>
                                </div>

                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="payment_mode">Select Payment Mode</label>
                                    
                                    <select  name="payment_mode" class=" form-control " id="payment_mode" required>
                                        @if (session()->has('laundry_order_info'))
                                        @if (session()->get('laundry_order_info')['payment_mode'] != '')
                                        <option value="{{session()->get('laundry_order_info')['payment_mode']}}" selected>Select Payment Mode</option>
                                        @endif
                                        @endif
                                        <option disabled>Select Payment Mode</option>

                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="Cash">Cash</option>
                                        <option value="ATM Card">ATM Card</option>
                                    </select>
                                </div>
                            </div>

                            <hr>
                        <a href="{{url('dashboard/laundry/basket/clear')}}" class="btn btn-danger btn-user btn-block">Clear Basket</a>

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
                                                    <input type="radio" name="laundry_type" value="pants">
                                                    <img src="https://static.thenounproject.com/png/1505542-200.png"
                                                        alt="Pants icon" style="width: 32px; height: 32px;">
                                                    <span>Pants</span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry_type" value="knickers">
                                                    <img src="https://static.thenounproject.com/attribution/1203658-600.png"
                                                        alt="Knickers icon" style="width: 32px; height: 32px;">
                                                    <span>Knickers</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry_type" value="bra">
                                                    <img src="https://static.thenounproject.com/attribution/5557174-600.png"
                                                        alt="Bra icon" style="width: 32px; height: 32px;">
                                                    <span>Bra</span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry_type" value="shirt">
                                                    <img src="https://static.thenounproject.com/attribution/1605025-600.png"
                                                        alt="Shirt icon" style="width: 32px; height: 32px;">
                                                    <span>Shirt</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry_type" value="socks">
                                                    <img src="https://static.thenounproject.com/attribution/5557074-600.png"
                                                        alt="Socks icon" style="width: 32px; height: 32px;">
                                                    <span>Socks</span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry_type" value="underwear">
                                                    <img src="https://static.thenounproject.com/attribution/3560200-600.png"
                                                        alt="Underwear icon" style="width: 32px; height: 32px;">
                                                    <span>Underwear</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry_type" value="wedding_dress">
                                                    <img src="https://static.thenounproject.com/attribution/1179049-600.png"
                                                        alt="Wedding icon" style="width: 32px; height: 32px;">
                                                    <span>Wedding Dress</span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry_type" value="suit">
                                                    <img src="https://static.thenounproject.com/attribution/1964510-600.png"
                                                        alt="Suits icon" style="width: 32px; height: 32px;">
                                                    <span>Suits</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry_type" value="Sleeve">
                                                    <img src="https://static.thenounproject.com/attribution/4132187-600.png"
                                                        alt="Sleeve icon" style="width: 32px; height: 32px;">
                                                    <span> Sleeve</span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry_type" value="Sweater">
                                                    <img src="https://static.thenounproject.com/attribution/1607917-600.png"
                                                        alt="Sweater icon" style="width: 32px; height: 32px;">
                                                    <span>Sweater</span>
                                                </label>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry_type" value="Complete">
                                                    <img src="https://static.thenounproject.com/attribution/178364-600.png"
                                                        alt="Complete icon" style="width: 32px; height: 32px;">
                                                    <span> Complete</span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry_type" value="Bedding">
                                                    <img src="https://static.thenounproject.com/attribution/5555943-600.png"
                                                        alt="Bedding icon" style="width: 32px; height: 32px;">
                                                    <span>Bedding</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry_type" value="Towel">
                                                    <img src="https://static.thenounproject.com/attribution/5550494-600.png"
                                                        alt="Towel icon" style="width: 32px; height: 32px;">
                                                    <span> Towel</span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry_type" value="Blanket">
                                                    <img src="https://static.thenounproject.com/attribution/4603776-600.png"
                                                        alt="Blanket icon" style="width: 32px; height: 32px;">
                                                    <span>Blanket</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry_type" value="Skirt">
                                                    <img src="https://static.thenounproject.com/attribution/2742585-600.png"
                                                        alt="Skirt icon" style="width: 32px; height: 32px;">
                                                    <span> Skirt</span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry_type" value="Curtain">
                                                    <img src="https://static.thenounproject.com/attribution/1544435-600.png"
                                                        alt="Curtain icon" style="width: 32px; height: 32px;">
                                                    <span>Curtain</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry_type" value="Gown">
                                                    <img src="https://static.thenounproject.com/attribution/3028777-600.png"
                                                        alt="Gown icon" style="width: 32px; height: 32px;">
                                                    <span> Gown</span>
                                                </label>
                                            </div>

                                            <div class="col-md-6">
                                                <label>
                                                    <input type="radio" name="laundry_type" value="Others">
                                                    
                                                    <span> Others</span>
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
                                    placeholder="number of materials" autocomplete="off" required>
                            </div>

                            <div class="col-sm-6 mb-3 mb-sm-0">

                                <label for="cost">Cost</label>
                                <input type="text" name="cost" id="cost" class="form-control"
                                    placeholder="Cost For Laundry" required>
                            </div>




                        </div>


                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Add To Laundry Basket
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
                        <div style="height: 300px; overflow-y: scroll;">
                            <table class="table table-striped" id="laundry-table">
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
                                    @if (session()->has('laundry_basket'))
                                        @php
                                            $item = session()->get('laundry_basket');
                                            $count_item = count($item);
                                        @endphp
                                        @for ($i = 0; $i < $count_item; $i++)
                                            <tr>
    
                                                <td>{{ $item[$i]['laundry_type'] }}</td>
                                                <td>{{ $item[$i]['description'] }}</td>
                                                <td>{{ $item[$i]['cost'] }}</td>
                                                <td>{{ $item[$i]['quantity'] }}</td>
                                                <td>
                                                    <button type="button" data-id="{{ $i }}"
                                                        class="btn delete-btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endfor
                                    @else
                                        <p>No Item In Laundry Basket</p>
                                    @endif
    
    
    
                                </tbody>
                            </table>
                        </div>

                        <div class="container">
                            <a href="{{url('dashboard/laundry/basket/view/receipt')}}" class="btn btn-success btn-user btn-block">View Order Receipt</a>
                        </div>

                       






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
                var $alert = $('.basket_alert');
                $.ajax({
                    url: "{{ url('dashboard/laundry/basket/add') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        // add the submitted data to the table
                        var tableRow = "<tr>" +
                            "<td>" + response.laundry_type + "</td>" +
                            "<td>" + response.description + "</td>" +
                            "<td>" + response.cost + "</td>" +
                            "<td>" + response.quantity + "</td>" +

                            "<td> <button type='button' class='btn delete-btn btn-danger btn-sm' data-id=' "+response.id +"'><i class='fa fa-trash'></i></button></td>" +
                            "</tr>";
                        $("#laundry-table tbody").append(tableRow);
                        $alert.addClass('alert-success');
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log("Error: " + errorThrown);
                    }
                });
            });

            // handle delete button click event
            $(document).ready(function() {
                // Attach click event listener to delete buttons
                $('.delete-btn').click(function() {
                    var itemId = $(this).data('id');
                    var token = $('meta[name="csrf-token"]').attr('content');

                    var deleteUrl = "{{ url('dashboard/laundry/basket/remove') }}"+ "/" + itemId;

                    // Make AJAX request to server to delete item
                    $.ajax({
                        url: deleteUrl,
                        method: 'POST',
                        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
                        success: function(response) {
                            // If deletion is successful, remove corresponding row from table
                            $('tr[data-id="' + itemId + '"]').remove();

                            // Show success message in alert
                            // $('.alert')
                            //     .removeClass('alert-danger')
                            //     .addClass('alert-success')
                            //     .find('p')
                            //     .text(response.message);
                            // $('.alert').show();
                        },
                        error: function(response) {
                            // If deletion fails, show error message in alert
                            $('.alert')
                                .removeClass('alert-success')
                                .addClass('alert-danger')
                                .find('p')
                                .text(response.responseJSON.message);
                            $('.alert').show();
                        }
                    });
                });
            });

            $("#laundry-table tbody").on("click", ".delete-btn", function() {
                $(this).closest("tr").remove();
            });
        });
    </script>
@endsection

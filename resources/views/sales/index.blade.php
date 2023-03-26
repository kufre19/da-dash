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
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
    @endif

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Sales</h1>

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-header">
                <h5>Filter By</h5>
            </div>
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <form action="{{ url('dashboard/sales/filter') }}" method="GET" class="users">
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="p-5">
                                {{-- <h5>By Date</h5> --}}
                                <div class="form-group">
                                    <label for="from_date">From:</label>
                                    <div class="input-group date">
                                        @php
                                            $from_date = session()->get('session_filters')['from_date'] ?? date('2022-01-01',);
                                        @endphp
                                        <input type="text" name="from_date" value="{{$from_date}}" class="form-control" id="datepicker_from"
                                            autocomplete="off">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="to_date">To:</label>
                                    <div class="input-group date">
                                        @php
                                        $to_date = session()->get('session_filters')['to_date'] ?? date('Y-m-d');
                                    @endphp
                                        <input type="text" name="to_date" value="{{$to_date}}" class="form-control" id="datepicker_to"
                                            autocomplete="off">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-5">

                                <div class="form-group">
                                    <label for="field1">Customer Number:</label>
                                    <input type="text" name="customer" value="{{session()->get('session_filters')['customer'] ?? ""}}" class="form-control" id="field1">
                                </div>
                                <div class="form-group">
                                    <label for="field2">Status:</label>
                                    <select name="order_status" class="form-control" id="field2">
                                        @php
                                            $session_order_status = session()->get('session_filters')['order_status'] ?? "";
                                        @endphp
                                        {{-- <option value="">Status</option> --}}
                                        <option value="processing" {{$session_order_status == 'processing' ? 'selected' : ''}} >Processing</option>
                                        <option value="completed" {{$session_order_status == 'completed' ? 'selected' : ''}}>Completed</option>
                                        <option value="cancelled" {{$session_order_status == 'cancelled' ? 'selected' : ''}}>Cancelled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-5">
                                <div class="form-group">
                                    <label for="field2">Payment Mode:</label>
                                    <select name="payment_status" class="form-control" id="field2">
                                        @php
                                            $session_payment_status = session()->get('session_filters')['payment_status'] ?? "";
                                        @endphp
                                        <option value="" >Select payment mode</option>
                                        <option value="paid" {{$session_payment_status == 'paid' ? 'selected' : ''}}>Paid</option>
                                        <option value="unpaid"  {{$session_payment_status == 'unpaid' ? 'selected' : ''}}>Unpaid</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <p>
                            <button type="submit" name="btn_filter" value="filter" class="btn btn-primary">Filter</button>
                        </p>
                        <p>
                            <button type="submit" name="btn_filter" value="clear" class="btn btn-danger">Clear Filter</button>
                        </p>
                    </div>
                </form>
            </div>
        </div>


        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Results</h5>
                <div>
                    <span class="mr-3">Total Items: {{$orders_count}}</span>
                    <span>Total Amount: {{env("CURRENCY_SYMBOL")}}{{$total_amount}}</span>
                </div>
            </div>

            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-12">
                        <div class="p-5">

                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" id="search" class="form-control"
                                        placeholder="Enter Search to filter by any column... ">
                                </div>
                            </div>
                            <br>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer phone</th>
                                        <th>Order Date</th>
                                        <th>Amount</th>


                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="orders">
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->order_number }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ $order->date }}</td>
                                            <td>{{ number_format($order->total_cost,2) }}</td>
                                           

                                            <td>
                                                <a href="{{ url('/dashboard/laundry/basket/preview') . '/' . $order->order_number }}"
                                                    class="btn btn-primary">More</a>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <p>{{ $orders->links() }}</p>
                                </tfoot>
                            </table>

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





    <script type="text/javascript">
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#orders tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection

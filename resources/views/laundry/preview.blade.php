@extends('layouts.custom.app')

@section('extraLinks')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style type="text/css">
        .receipt {
            border: 2px solid #000;
            padding: 20px;
            margin-top: 50px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endsection

@section('page_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Laundry Order Preview <a href=""></a></h1>

    </div>
    <!-- /.container-fluid -->

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-12">
                    <div class="p-5">

                        @if (isset($order_status))
                            <form action="{{ url('dashboard/laundry/orders/update/status') }}" method="POST"
                                class="users">
                                @csrf

                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control" id="status" name="status">

                                        <option value="processing" {{ $order_status == 'processing' ? 'selected' : '' }}>
                                            Processing
                                        </option>
                                        <option value="completed" {{ $order_status == 'completed' ? 'selected' : '' }}>
                                            Completed
                                        </option>
                                        <option value="cancelled" {{ $order_status == 'cancelled' ? 'selected' : '' }}>
                                            Cancelled
                                        </option>
                                    </select>
                                    <input type="hidden" name="order_number" value="{{ $order_number }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Status</button>
                            </form>
                        @endif
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

                        </div>
                        <div id="laundry_form" class="user">
                            <div class="receipt" id="receipt">
                                <h2 class="text-center mb-4">{{ env('APP_NAME') }} Order Receipt</h2>
                                <h5 class="text-center mb-4">company address</h5>

                                <div class="row mb-4">
                                    <div class="col-6">
                                        <p><strong>Customer Name:</strong> {{ $customer->name }}</p>
                                        <p><strong>Order Date:</strong> {{ $order_date }}</p>



                                    </div>
                                    <div class="col-6 text-right">
                                        <p><strong>Payment Mode:</strong> {{ $payment_mode ?? 'NA' }}</p>
                                        <p><strong>Order Number:</strong> {{ $order_number ?? 'NA' }}</p>
                                        <p><strong>Phone Number:</strong> {{ $customer->phone }}</p>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Laundry Type</th>
                                            <th>Description</th>
                                            <th>Cost</th>
                                            <th>Quantity</th>
                                            <th>Total Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (session()->has('laundry_basket'))
                                            @foreach (session()->get('laundry_basket') as $item)
                                                <tr>
                                                    <td>{{ $item['laundry_type'] }}</td>
                                                    <td>{{ $item['description'] }}</td>
                                                    <td>{{ $item['cost'] }}</td>
                                                    <td>{{ $item['quantity'] }}</td>
                                                    <td>{{ $item['quantity'] * $item['cost'] }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            @foreach ($order_items as $item)
                                                <tr>
                                                    <td>{{ $item['laundry_type'] }}</td>
                                                    <td>{{ $item['description'] }}</td>
                                                    <td>{{ $item['cost'] }}</td>
                                                    <td>{{ $item['quantity'] }}</td>
                                                    <td>{{ $item['quantity'] * $item['cost'] }}</td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        <tr>
                                            <td colspan="4" class="text-right">
                                                <strong>Total Cost:</strong><br>
                                                <strong>Total Item Count:</strong>
                                            </td>
                                            <td><strong>{{ $total_cost }}</strong><br>
                                                <strong>{{ $item_count ?? 'NA' }}</strong>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>

                            </div>





                            <hr>
                            <div class="container">
                                @if (isset($order_number))
                                    <button class="btn btn-success btn-block" id="print-receipt-btn"
                                        onclick="printReceipt()">Print Receipt</button>
                                @endif
                                @if (isset($order_number))
                                    <button class="btn btn-primary btn-block" id="print-receipt-btn"
                                        data-label-data="{{ $order_number }}"
                                        onclick="printLabel({{ $order_number }})">Print Tags</button>

                                    @if (isset($image_uploaded) && $image_uploaded == 1)
                                        <a href="{{ url('dashboard/laundry/basket/gallery/view' . '/' . $order_number) }}"
                                            class="btn btn-primary btn-user btn-block">View Laundry Gallery</a>
                                    @endif
                                @else
                                    <a href="{{ url('dashboard/laundry/create/order') }}"
                                        class="btn btn-primary btn-user btn-block">Create Laundry Order</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection




@section('extraJS')
    <!-- Load jQuery and Select2 JavaScript libraries from a CDN or include them in your project -->



    <script type="text/javascript">
        function printReceipt() {
            var printContents = document.getElementById("receipt").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }


        function printLabel(labelData) {
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = labelData;

            // Add print styles to the page
            var printCSS = '@media print { @page { size: 4in 6in; } }';
            var printStyle = document.createElement('style');
            printStyle.type = 'text/css';
            printStyle.appendChild(document.createTextNode(printCSS));
            document.head.appendChild(printStyle);

            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection

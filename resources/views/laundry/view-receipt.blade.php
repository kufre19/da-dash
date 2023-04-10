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
        <h1 class="h3 mb-4 text-gray-800">Laundry Order Receipt <a href=""></a></h1>

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

                        </div>
                        <div id="laundry_form" class="user">
                            <div class="receipt" id="receipt">
                                <h2 class="text-center mb-4">{{ env('APP_NAME') }} Order Receipt</h2>
                                <h5 class="text-center mb-4">{{ env('COMPANY_ADDRESS') }}</h5>

                                <div class="row mb-4">
                                    <div class="col-6">
                                        <p><strong>Customer Name:</strong> {{ $customer->name }}</p>
                                        <p><strong>Order Date:</strong> {{ $order_date }}</p>
                                    </div>

                                    <div class="col-6 text-right">
                                        <p><strong>Payment Mode:</strong> {{ $payment_mode ?? 'NA' }}</p>
                                        <p><strong>Order Number:</strong> {{ $order_number ?? 'NA' }}</p>
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
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" style="position: relative; text-align: center;">
                                                <svg id="barcode"></svg>
                                            </td>
                                        </tr>
                                    </tfoot>
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
                                        data-label-data="{{ $order_number }}" onclick="printLabel()">Print Tags</button>

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
    <script src="{{ asset('js/custom/JsBarcode-master/dist/JsBarcode.all.min.js') }}"></script>




    <script>
        var order_number = {{ $order_number ?? 'empty' }}
        JsBarcode("#barcode", order_number, {
            format: "code39",
            displayValue: false,
            fontSize: 20,
            margin: 10,
            width: 2,
            height: 100
        });
    </script>

    <script type="text/javascript">
        function printReceipt() {
            var printContents = document.getElementById("receipt").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;

            // Add CSS to avoid page break inside certain elements
            var style = document.createElement('style');
            style.innerHTML = '@media print { * { page-break-inside: avoid; } }';
            document.head.appendChild(style);

            window.print();

            // Restore original contents
            document.body.innerHTML = originalContents;
        }






        function printLabel() {
            var originalContents = document.body.innerHTML;
            var labelData = "<p>" + "{{ $order_number ?? '' }}" + "<br>" + "{{ $customer->name }}" + "<br>" +
                "{{ $customer->phone }}" + "<br>" +
                "{{ $order_shelf ?? '' }}" + "</p>"
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

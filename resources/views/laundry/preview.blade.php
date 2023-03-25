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
        <h1 class="h3 mb-4 text-gray-800">Laundry Order Preview/Update <a href=""></a></h1>

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

                <div class="col-12">
                    <div class="p-5">

                        @if (isset($payment_status))
                            <form action="{{ url('dashboard/laundry/orders/update/payment/status') }}" method="POST"
                                class="users">
                                @csrf

                                <div class="form-group">
                                    <label for="status">Payment Status:</label>
                                    <select class="form-control" id="status" name="payment_status">

                                        <option value="Paid" {{ $payment_status == 'Paid' ? 'selected' : '' }}>
                                            Paid
                                        </option>
                                        <option value="Unpaid" {{ $payment_status == 'Unpaid' ? 'selected' : '' }}>
                                            Unpaid
                                        </option>
                                        {{-- <option value="cancelled" {{ $payment_status == 'cancelled' ? 'selected' : '' }}>
                                            Cancelled
                                        </option> --}}
                                    </select>
                                    <input type="hidden" name="order_number" value="{{ $order_number }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Payment Status</button>
                            </form>
                        @endif
                    </div>
                </div>
                @if (isset($order_number))
                    <div class="col-12">
                        <div class="p-5">


                            <form action="{{ url('dashboard/laundry/orders/update/shelf/') }}" method="POST"
                                class="users">
                                @csrf

                                <div class="form-group">
                                    <label for="shelf">Update Order Shelf Location:</label>
                                    <select class="form-control" id="shelf" name="shelf">
                                        @foreach ($shelves as $shelf)
                                            <option value="{{ $shelf->name }}"
                                                {{ $shelf->name == $order_shelf ? 'selected' : '' }}>
                                                {{ $shelf->name }}
                                            </option>
                                        @endforeach


                                    </select>
                                    <input type="hidden" name="order_number" value="{{ $order_number }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Order Shelf</button>
                            </form>

                        </div>
                    </div>
                @endif

            </div>


        </div>
    </div>

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-header">
            <h5>Order Items</h5>
        </div>
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->

            <div class="row">
                <div class="col-12">
                    <div style="height: 300px; overflow-y: scroll;">
                        <table class="table table-striped" id="laundry-table">
                            <thead>
                                <tr>
                                    <th>Laundry Type</th>
                                    <th>Description</th>
                                    <th>Cost</th>
                                    <th>Qty</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($order_items))
                                    @php
                                        $item = $order_items;
                                        $count_item = count($item);
                                    @endphp
                                    @for ($i = 0; $i < $count_item; $i++)
                                        <tr>

                                            <td>{{ $item[$i]['laundry_type'] }}</td>
                                            <td>{{ $item[$i]['description'] }}</td>
                                            <td>{{ $item[$i]['cost'] }}</td>
                                            <td>{{ $item[$i]['quantity'] }}</td>

                                        </tr>
                                    @endfor
                                @else
                                    <p>No Item In Laundry Basket</p>
                                @endif

                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url('dashboard/laundry/basket/view/receipt' . '/' . $order_number) }}"
            class="btn btn-primary btn-user btn-block">View Receipt</a>
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


        function printLabel() {
            var originalContents = document.body.innerHTML;
            var labelData = "<p>" + "{{ $order_number }}" + "<br>" + "{{ $customer->name }}" + "<br>" +
                "{{ $customer->phone }}" + "<br>" +
                "{{ $order_shelf }}" + "</p>"
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

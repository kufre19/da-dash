@extends('layouts.custom.app')

@section('extraLinks')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Laundry Orders <a href=""></a></h1>

    </div>
    <!-- /.container-fluid -->

    <div class="row">
        <div class="col-md-6">
            <input type="text" id="search" class="form-control" placeholder="Search to filter by any column... ">
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
                <th>Payment Mode</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="orders">
            @foreach ($orders as $order)
                <tr>
                    <td>{{$order->order_number}}</td>
                    <td>{{$order->name}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->date}}</td>
                    <td>{{$order->payment_mode}}</td>
                    <td>{{$order->status}}</td>
                    <td>
                        <a href="{{url('/dashboard/laundry/basket/preview').'/'.$order->order_number}}" class="btn btn-primary">Preview</a>
                        <a href="{{url('/dashboard/laundry/basket/gallery/view').'/'.$order->order_number}}" class="btn btn-primary">View Gallery</a>
                    </td>

                </tr>
            @endforeach



        </tbody>

        <tfoot>
            <p>{{$orders->links()}}</p>
        </tfoot>
    </table>
@endsection




@section('extraJS')
    <!-- Load jQuery and Select2 JavaScript libraries from a CDN or include them in your project -->

    <script src="{{ asset('css/custom/select2/dist/js/select2.min.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>





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

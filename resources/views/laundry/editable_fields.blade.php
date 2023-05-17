@if (Auth::user()->role != 'Factory')
    <div class="row">
        <div class="col-12">
            <div class="p-5">

                @if (isset($order_status))
                    <form action="{{ url('dashboard/laundry/orders/update/status') }}" method="POST" class="users">
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
                <form action="{{ url('dashboard/laundry/orders/update/payment/mode') }}" method="POST" class="users">
                    @csrf
                    <label for="payment_mode">Updae Payment Mode</label>

                    <select name="payment_mode" class=" form-control " id="payment_mode" required>

                        <option disabled>Select Payment Mode</option>

                        <option value="Bank Transfer"{{ $payment_mode == 'Bank Transfer' ? 'selected' : '' }}>Bank
                            Transfer</option>
                        <option value="Cash"{{ $payment_mode == 'Cash' ? 'selected' : '' }}>Cash</option>
                        <option value="ATM Card"{{ $payment_mode == 'ATM Card' ? 'selected' : '' }}>ATM Card</option>
                    </select>
                    <input type="hidden" name="order_number" value="{{ $order_number }}">
                    <br>
                    <button type="submit" class="btn btn-primary">Update Payment Mode</button>

                </form>

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


                    <form action="{{ url('dashboard/laundry/orders/update/shelf/') }}" method="POST" class="users">
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

@else



<div class="row">
    <div class="col-12">
        <div class="p-5">

            @if (isset($order_status))
                <form action="{{ url('dashboard/laundry/orders/update/status') }}" method="POST" class="users">
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

    

    
    @if (isset($order_number))
        <div class="col-12">
            <div class="p-5">


                <form action="{{ url('dashboard/laundry/orders/update/shelf/') }}" method="POST" class="users">
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



@endif

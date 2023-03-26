<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait Sales
{


    public function show_sales_index_Page()
    {
        $orders_data = $this->allSalesWithCustomer();
        $orders = $orders_data['orders_paginate'];
        $orders_count = $orders_data['order_count'];
        $total_amount =  $orders_data['total_amount'];
        return view("sales.index", compact("orders", "orders_count", "total_amount"));
    }

    public function show_sales_index_Page_filter(Request $request)
    {

        $btn_filter = $request->input("btn_filter");
        if ($btn_filter == "clear") {
            // clear filter session and return to 
            session()->forget("session_filters");
            $orders_data = $this->allSalesWithCustomer();
            $orders = $orders_data['orders_paginate'];
            $orders_count = $orders_data['order_count'];
            $total_amount =  $orders_data['total_amount'];
            return view("sales.index", compact("orders", "orders_count", "total_amount"));
        }

        $orders_data = $this->allSalesWithCustomerFilter($request);
        $orders = $orders_data['orders_paginate'];
        $orders_count = $orders_data['order_count'];
        $total_amount =  $orders_data['total_amount'];
        return view("sales.index", compact("orders", "orders_count", "total_amount"));
    }
}

<?php

namespace App\Traits;

use App\Models\Customers;
use App\Models\Laundry;
use Carbon\Carbon;

trait Analytics
{

    public function getCurrentMonthSales()
    {
        $orders_model = new Laundry();
        $currentMonth = Carbon::now()->month;

        $orders = $orders_model->whereMonth("created_at",$currentMonth)->get();
        $order_count = count($orders);
        $total_amount = 0;

        $currentDate =  $currentDate = Carbon::today();
        $status = "processing";
        $processing_orders = $orders_model->whereDate("created_at",$currentDate)->where('status', $status)->get()->count();

        foreach ($orders as $key => $value) {
            $total_amount += $value->total_cost;
        }
        $total_amount = number_format($total_amount,2);
        

        return ["order_count"=>$order_count,"total_amount"=>$total_amount,"processing_orders"=>$processing_orders];
    }

    public function customer_count()
    {
        $customer_model = new Customers();

        $customer = $customer_model->get();
        $customer_count = count($customer);
        
        return ['customer_count'=>$customer_count];
    }

    
}

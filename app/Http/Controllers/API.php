<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Laundry;
use Illuminate\Http\Request;

class API extends Controller
{
    public function upload_from_offline(Request $request)
    {

      

        /* this here will prevent the system from breaking when session has been cleared but user somehow still gets to submit create button */
        
        $customer_model = new Customers();
        $laundry_model = new Laundry();
        $laundry = $laundry_model->where("order_number",$request['order_number'])->first();

        $customer = $customer_model->where("phone",$request['customer_phone'])->first();
        
        
        
        if($laundry){
            return response("saved alrady",200);
        }
        if (!$customer) {
            $customer = new Customers();
            $customer->name = $request['customer_name'];
            $customer->phone = $request['customer_phone'];
            $customer->save();
        }

    
        


        $laundry_model->order_items =  json_encode($request['order_items'])  ;
        // dd( $customer->id, $request['order_items']);
        $laundry_model->customer_id = $customer->id;
        $laundry_model->date = $request['laundry_date'];
        $laundry_model->total_cost = $request['total_cost'];
        // $laundry_model->payment_mode = $order_info['payment_mode'];
        $laundry_model->payment_status = $request['payment_status'];
        $laundry_model->order_number =  $request['order_number'];
        $laundry_model->save();
        

        return response("ok",200);

    }
}

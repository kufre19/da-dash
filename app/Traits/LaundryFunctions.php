<?php

namespace App\Traits;

use App\Models\Customers;

trait LaundryFunctions {


    public function laundry_create_page()
    {
        $customer_model = new Customers();
        $customers = $customer_model->get();
        return view("laundry.create",compact("customers"));
    }

}
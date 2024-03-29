<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\AdminFunctions;
use App\Traits\Analytics;
use App\Traits\Customers;
use App\Traits\LaundryFunctions;
use App\Traits\Sales;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use AdminFunctions,Customers, LaundryFunctions,Analytics,Sales;
    public function __construct()
    {
        $this->middleware('auth');
    }

    
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\AdminFunctions;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use AdminFunctions;
    public function __construct()
    {
        $this->middleware('auth');
    }

    
}

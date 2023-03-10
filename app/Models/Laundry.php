<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Laundry extends Model
{
    use HasFactory;

    public function fetch_orders()
    {
        $orders = DB::table('laundries')
        ->join('customers', 'laundries.customer_id', '=', 'customers.id')
        ->select('laundries.*', 'customers.name', 'customers.phone')
        ->orderBy("created_at",'DESC')
        ->paginate(10);

        // dd($orders);

        return $orders;

    }
}

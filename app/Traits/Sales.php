<?php
namespace App\Traits;


trait Sales {


    public function show_sales_index_Page()
    {
        return view("sales.index");
    }
}
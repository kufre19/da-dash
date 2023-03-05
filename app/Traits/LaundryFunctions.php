<?php

namespace App\Traits;

use App\Models\Customers;
use App\Models\Laundry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

trait LaundryFunctions {


    public function laundry_create_page()
    {
        // dd(session()->get('laundry_basket'));
        $customer_model = new Customers();
        $customers = $customer_model->get();
        return view("laundry.create",compact("customers"));
    }


    public function laundry_create(Request $request)
    {
        $laundry_basket = session()->get("laundry_basket");
        $order_info = session()->get("laundry_order_info");
        $order_items = json_encode(session()->get("laundry_basket"));
        $total_cost = $this->basket_total_cost();

        $laundry_model = new Laundry();
        $laundry_model->order_items = $order_items;
        $laundry_model->customer_id = $order_info['customer'];
        $laundry_model->date = $order_info['laundry_date'];
        $laundry_model->total_cost = $total_cost;
        $laundry_model->order_number = $this->generate_order_id();


       $laundry_model->save();
       $this->laundry_basket_clear();

        return redirect()->to("dashboard/laundry/basket/preview"."/" .$laundry_model->order_number);


    }

    public function laundry_basket_remove($id)
    {

        $laundry_basket = session()->get("laundry_basket");
        unset($laundry_basket[$id]);
        $laundry_basket = array_values($laundry_basket);
        session()->put("laundry_basket",$laundry_basket);
        return response()->json([],200);

    }

    public function laundry_basket_add(Request $request)
    {
        $customer = $request->input('customer');
        $description = $request->input('description');
        $laundry_type = $request->input('laundry_type');
        $laundry_date = $request->input('laundry_date');
        $quantity = $request->input('quantity');
        $cost = $request->input('cost');

        $laundry_order_info = ['customer'=>$customer,'laundry_date'=>$laundry_date];
        session()->put("laundry_order_info",$laundry_order_info);

        if ($laundry_type == "") {
            $laundry_type = "NA";
        }

        if(session()->has("laundry_basket"))
        {
            $laundry_basket = session()->get("laundry_basket");
        }else{
            session()->put("laundry_basket",[]);
            $laundry_basket = session()->get("laundry_basket");
        }

        $data = [
            'description'=>$description,
            'laundry_type'=>$laundry_type,
            'quantity'=>$quantity,"cost"=>$cost];

         array_push($laundry_basket,$data);
        session()->put("laundry_basket",$laundry_basket);
        $id = count(session()->get("laundry_basket")) - 1;
            $response_data = [
                "message"=>"laundry added!","type"=>"success",
                'description'=>$description,
                'laundry_type'=>$laundry_type,
                'quantity'=>$quantity
                ,"cost"=>$cost,
                "id"=>$id
            ];
        return response()->json($response_data,200);



    }

    public function laundry_basket_clear()
    {
        Session::forget("laundry_basket");
        Session::forget("laundry_order_info");
        return redirect()->back();

    }

    public function basket_total_cost()
    {
        $laundry_basket = session()->get("laundry_basket");
        $total = 0;
        foreach ($laundry_basket as $key => $value) {
           $cost = $value['quantity'] * $value['cost'];
           $total += $cost;
        }
        return number_format($total,2);

    }


    public function laundry_preview_page($id = "")
    {
        
        if($id != "")
        {
           
            $laundry_model = new Laundry();
            $laundry = $laundry_model->where("order_number",$id)->first();

            if(!$laundry)
            {
                return redirect()->to("dashboard/laundry/create/");
            }

            $customer_model = new Customers();
            $customer = $customer_model->where("id",$laundry->customer_id)->first();

            $order_date = $laundry->date;
            $order_items =json_decode($laundry->order_items, true);
            $item_count = count($order_items);
            $order_number = $laundry->order_number;
            $total_cost = $laundry->total_cost;
            $image_uploaded = $laundry->image_uploaded;



            return view("laundry.preview",compact("customer","order_date","order_items","order_number","total_cost","item_count","image_uploaded"));

        }elseif (session()->has("laundry_order_info") && session()->has("laundry_basket")) {
            $order_info = session()->get("laundry_order_info");
            $customer_id = $order_info['customer'];
            $order_date = $order_info['laundry_date'];
            $total_cost = $this->basket_total_cost();
    
            $customer_model = new Customers();
            $customer = $customer_model->where("id",$customer_id)->first();
    
            
            return view("laundry.preview",compact("customer","order_date","total_cost"));
        }else{
            return redirect()->back();
        }
       
    }


    public function generate_order_id()
    {
        $laundry_model = new Laundry();
        $new_id =  random_int(100000, 999999);;
        
        $check = $laundry_model->where("order_number",$new_id)->first();
      
        if($check != null)
        {
            $this->generate_order_id();
        }else{
            return $new_id;
        }
    }

    public function laundry_gallery($id)
    {

    }

    public function laundry_image_upload_page()
    {
        return view("laundry.upload_image");
    }

}
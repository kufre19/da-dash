<?php

namespace App\Traits;

use App\Models\ServicesOffered;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait AdminFunctions 
{

    public function createUserAccount_page()
    {
        $roles = Config::get('user_roles');
        return view("users_page.create",compact("roles"));
    }

    public function editAccount_page($id)
    {
        $roles = Config::get('user_roles');
        $user = User::fecth_user_by_id($id);
        return view("users_page.edit_user",compact("user","roles"));

    }

    public function createUserAccount(Request $request)
    {
        $name = $request->input('name');
        $password = $request->input('password');
        $role = $request->input('role'); 
        
        $data = ['name'=>$name,"password"=>$password,"role"=>$role];
        User::create_user_accounts($data);
        session()->flash('success', 'Account Created!');
        return redirect()->back();
    }

    public function editUserAccount(Request $request)
    {
        $name = $request->input('name');
        $password = $request->input('password');
        $role = $request->input('role');
        $id = $request->input('id');
        
        $data = ['name'=>$name,"password"=>$password,"role"=>$role,'id'=>$id];
        User::edit_account($data);
        session()->flash('success', 'Account Edited!');
        return redirect()->back();
    }

    public function listAccounts()
    {
        $users = User::list_users();
        return view("users_page.list_users",compact("users"));
 
    }

    public function deleAccount($id)
    {
      
            $users = User::delete_user($id);
            session()->flash('success', 'Account deleted!');
            return redirect()->back();
     
    }

    public function showServicePage()
    {
        return view("services.create");
    }

    public function showServiceEditPage($id)
    {
        $service = ServicesOffered::fetchServiceById($id);
        return view("services.edit",compact('service'));

    }

    public function createService(Request $request)
    {
        $service = $request->input('service');
        $data = ["service"=>$service];
        ServicesOffered::addNewService($data);
        session()->flash('success', 'Service Added!');
        return redirect()->back();

    }

    public function listServices()
    {
        $services = ServicesOffered::fetchServices();
        return view("services.list",compact('services'));
    }
    public function deleteService($id)
    {
      
            $users = ServicesOffered::delete_service($id);
            session()->flash('success', 'Service deleted!');
            return redirect()->back();
     
    }

    public function editService(Request $request)
    {
        $service = $request->input('service');
        $id = $request->input('id');
        $data = ["service"=>$service,'id'=>$id];
        ServicesOffered::editService($data);
        session()->flash('success', 'Service edited!');
        return redirect()->back();
    }


   
    
}
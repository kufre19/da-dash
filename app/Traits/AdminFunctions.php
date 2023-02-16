<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;


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
    
}
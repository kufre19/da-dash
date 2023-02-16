<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

/* 
roles: 1 -admin
       2 - staff
*/

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password'
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function create_user_accounts(array $data)
    {
        $model = new User();
        $model->name = $data['name'];
        $model->password = Hash::make($data['password']);
        $model->role = $data['role'];
        $model->save();
        return true;
    }

    public static function edit_account(array $data)
    {
        $model = new User();
       
        if($data['password'] != "")
        {
            $model->where('id',$data['id'])->update([
                "password"=>Hash::make($data['password']),
                "name"=>$data['name'],
                "role"=>$data['role']
            ]);
        }else{
            $model->where('id',$data['id'])->update([
                "name"=>$data['name'],
                "role"=>$data['role']
            ]);
        }
        return true;
    }

    public static function fecth_user_by_role($role)
    {
        $model = new User();
        $user = $model->where('role', $role)->get();
        if (!$user) {
            return false;
        }
        return $user;
    }

    public static function fecth_user_by_id($id)
    {
        $model = new User();
        $user = $model->where('id', $id)->first();
        if (!$user) {
            return false;
        }
        return $user;
    }


    public static function list_users()
    {
        $loggedInUserId = auth()->id();

        // Get all users except the logged in user, paginated
        $model = new User();
        $users = $model->where('id', '<>', $loggedInUserId)->paginate(10);
        return $users;
    }

    public static function delete_user($id)
    {
        // Get all users except the logged in user, paginated
        $model = new User();
        $users = $model->where('id', '=', $id)->delete();
        return true;
    }



}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesOffered extends Model
{
    use HasFactory;


    public static function addNewService(array $data)
    {
        $model = new ServicesOffered();

        $model->service = $data['service'];
        $model->save();
        return true;
    }

    public static function editService(array $data)
    {
        $model = new ServicesOffered();

        $service= $data['service'];
        $id = $data['id'];
        $model->where('id',$id)
        ->update([
            "service"=>$service
        ]);
        return true;
    }

    public static function fetchServiceById($id)
    {
        $model = new ServicesOffered();
        $data = $model->where('id',$id)->first();
        return $data;
    } 

    public static function fetchServices()
    {
        $model = new ServicesOffered();
        $data = $model->paginate(15);
        return $data;
    }

    public static function delete_service($id)
    {
        $model = new ServicesOffered();
        $model->where('id',$id)->delete();

        return true;
    }
}

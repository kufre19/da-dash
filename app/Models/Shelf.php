<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    use HasFactory;

    public static function editShelf(array $data)
    {
        $model = new Shelf();

        $shelf= $data['shelf'];
        $id = $data['id'];
        $model->where('id',$id)
        ->update([
            "name"=>$shelf
        ]);
        return true;
    }


    public static function fetchShelfById($id)
    {
        $model = new Shelf();
        $data = $model->where('id',$id)->first();
        return $data;
    } 
}

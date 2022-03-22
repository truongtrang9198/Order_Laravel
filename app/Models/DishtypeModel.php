<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishtypeModel extends Model
{
    use HasFactory;
    protected $table  = 'dish_type';
    protected $primaryKey = 'ID_DISH_TYPE';
    public $timestamps = false;

    public function menu()
    {
        return $this->hasMany('App\Models\MenuModel','ID_DISH_TYPE','ID_DISH_TYPE');

    }
    public function get_all(){
       $result =  DishtypeModel::all();
       return $result;
    }
}

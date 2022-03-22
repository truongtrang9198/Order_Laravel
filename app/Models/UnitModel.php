<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitModel extends Model
{
    use HasFactory;
    protected $table  = 'unit';
    protected $primaryKey = 'ID_UNIT';
    public $timestamps = false;

    public function menu()
    {
        return $this->hasMany('App\Models\MenuModel','ID_UNIT','ID_UNIT');
    }
    public function get_all(){
        $result = UnitModel::all();
        return $result ;
    }

}

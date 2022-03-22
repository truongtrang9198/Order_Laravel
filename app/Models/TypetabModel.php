<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypetabModel extends Model
{
    protected $table  = 'table_type';
    protected $primaryKey = 'ID_TABLE_TYPE';
    public $timestamps = false;

    public function get(){
        $result = TypetabModel::all();
        return $result;
    }
}

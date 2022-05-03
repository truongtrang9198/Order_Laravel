<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class CustomerModel extends Model
{
    use HasFactory;
    protected $table  = 'customers';
    protected $primaryKey = 'ID_CUSTOMERS';
    public $timestamps = false;

    public function Total($id_customer){
        $result = DB::select("call money_spent($id_customer)");
        return $result;
    }

    public function customer_history($id_customer){
        $result = DB::select("call customer_history($id_customer)");
        return $result;
    }
}

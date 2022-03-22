<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressModel extends Model
{
    protected $table  = 'address';
    protected $primaryKey = 'ID_ADDRESS';
    public $timestamps = false;


}

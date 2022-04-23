<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    use HasFactory;
    protected $table = "payment";
    protected $primaryKey = 'ID_PAYMENT';
    public $timestamps = false;


}

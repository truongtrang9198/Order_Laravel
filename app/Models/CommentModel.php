<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{

    protected $table  = 'comment';
    protected $primaryKey = 'ID_COMMENT';
    public $timestamps = false;

}

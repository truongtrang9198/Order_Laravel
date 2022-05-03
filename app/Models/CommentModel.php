<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class CommentModel extends Model
{

    protected $table  = 'comment';
    protected $primaryKey = 'ID_COMMENT';
    public $timestamps = false;
// Lấy bình luận và tên khách hàng
    public function get_cmt($id){
        $result = DB::select("call get_comment($id)");
        return $result;
    }

}

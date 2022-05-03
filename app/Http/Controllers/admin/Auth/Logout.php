<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StaffModel as StaffModel;
use DB;
use App\Models\User as User;
use App\Models\PositionModel as PositionModel;

class Logout extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

?>

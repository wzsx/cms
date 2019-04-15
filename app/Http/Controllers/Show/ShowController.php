<?php
namespace App\Http\Controllers\Show;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class ShowController extends Controller
{
    public function show(){
        return view('show.show');
    }
    public function uploadinfo(){
        $tmpname=['file'][''];
    }
}
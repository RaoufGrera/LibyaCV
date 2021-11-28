<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class newsController extends Controller
{
    //
    public function index(){
        return view('news');
    }
    
    public function addnews(){
        
        return response()->json('                    <table class="table">
                        <tr>
                            <th>الأسم</th>
                            <th>الجد</th>
                            <th>الميلاد</th>
                            <th>الجنسية</th>

                        </tr></table>');
        
    }
        public function store(){
        
        return Response::json('storedd');
        
    }
}

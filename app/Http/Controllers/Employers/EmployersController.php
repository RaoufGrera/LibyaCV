<?php

namespace App\Http\Controllers\Employers;

use Illuminate\Http\Request;
use Auth;
use DB;

use Crypt;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmployersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
    }
    public function index(){
        $id = Auth::guard('employers')->user()->emp_id;

        $employers = DB::table('employers')
            ->where('employers.emp_id','=',$id)->First();

        return view('employers.company')
            ->with('employers',$employers);
    }
    public function change(Request $request){
        $id = Auth::guard('employers')->user()->emp_id;

            if(strlen($request->input('pass_new')) >= 6){
                $pass_old =  Crypt::encrypt($request->input('pass_old'));
                $pass_new =  Crypt::encrypt($request->input('pass_new'));

                $result = DB::table('employers')
                    ->select('password')
                    ->where('emp_id','=',$id)->first();

                if($result->password  == $pass_old ){

                    DB::table('employers')
                        ->where('emp_id', $id)
                        ->update([
                            'password' => $pass_new,
                        ]);
                    return redirect('/company#yes');
                }else{
                    return redirect('/company#e');
                }
    }

    }

}

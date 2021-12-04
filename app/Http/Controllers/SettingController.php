<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers;

class SettingController extends Controller
{
    public function index()
    {
        $seekers_id =session('seeker_id');
/*
        $job_seeker = Helpers::getDataSeeker('seekers',$seekers_id,false);

        $hide = $job_seeker->hide_cv;
*/
        $job_seeker = DB::table('seekers')->select('hide_cv','phone_view','image_view')
            ->where('seeker_id',$seekers_id)->first();


        return view('seekers.settings')->with('job_seeker',$job_seeker);
    }

    public function changeImage(Request $request){
        $seekers_id = session('seeker_id');

        $statusImage = $request->input('image');
        if($statusImage ==null)
            $statusImage=0;
        DB::table('seekers')
            ->where('seeker_id', $seekers_id)
            ->update([
                'image_view' => $statusImage,
            ]);

         Helpers::getDataSeeker('seekers',$seekers_id,true);

        return redirect('/profile/settings')->with('ok', 'تم تعديل أعدادات السيرة الذاتية بنجاح');
    }

    public function changePhone(Request $request){
        $seekers_id = session('seeker_id');

        $statusPhone = $request->input('phone');

        if($statusPhone ==null)
            $statusPhone=0;
        DB::table('seekers')
            ->where('seeker_id', $seekers_id)
            ->update([
                'phone_view' => $statusPhone,
            ]);
        Helpers::getDataSeeker('seekers',$seekers_id,true);

        return redirect('/profile/settings')->with('ok', 'تم تعديل أعدادات السيرة الذاتية بنجاح');
    }

    public function changePassword(Request $request)
    {
        $seekers_id = session('seeker_id');
        $status = false;
        if (strlen($request->input('password')) >= 6) {
            $pass_old = $request->input('password');
            $pass_new = Hash::make($request->input('newpassword'));

            $check = DB::table('seekers')
                ->select('password')
                ->where('seeker_id', $seekers_id)
                ->first();

            $status = Hash::check($pass_old,  $check->password);

            if ($status){

                DB::table('seekers')
                    ->where('seeker_id', $seekers_id)
                    ->update([
                        'password' => $pass_new,
                    ]);
                return redirect('/profile/settings')->with('ok', 'تم تغيير كلمة السر بنجاح.');
            }
        }

        return redirect('/profile/settings')->with('error', 'لم يتم تغيير كلمة السر.');
    }

    public function delete(Request $request)
    {
        $seekers_id = session('seeker_id');


 
        DB::table('seekers')
            ->where('seeker_id', $seekers_id)
            ->delete();
     //   Helpers::getDataSeeker('seekers',$seekers_id,true);

        return redirect('/login');
    }
    public function changeCV(Request $request)
    {
        $seekers_id = session('seeker_id');



        $statusCV = $request->input('cv');

        DB::table('seekers')
            ->where('seeker_id', $seekers_id)
            ->update([
                'hide_cv' => $statusCV,
            ]);
        Helpers::getDataSeeker('seekers',$seekers_id,true);

        return redirect('/profile/settings')->with('ok', 'تم تعديل أعدادات السيرة الذاتية بنجاح');
    }

}

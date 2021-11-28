<?php
/**
 * Created by PhpStorm.
 * User: Asasna
 * Date: 10/25/2017
 * Time: 11:55 AM
 */

namespace App\Helpers;
use App\Helpers\CompanyConstant;
use Redis;
use Session;
use Auth;
use App\Helpers;
class CompanyClass implements CompanyConstant
{

    public function getCompany(){

        if(session('have_company') !=1)
            return null;
         if(session()->has('seeker_id')){
            $id = session('seeker_id');
        } else{
            $id = Auth::guard('users')->user()->seeker_id;//Auth::user()->seeker_id;
         }

        return Helpers::getDataSeeker('seekerCompany',$id,false);



    }

    public function getNote(){

       // Session::flush();
       if(session()->has('seeker_id')){
            $id = session('seeker_id');
        } else{
            if(Auth::guard('users')->check()){
                $id = Auth::guard('users')->user()->seeker_id;

                Helpers::getDataSeeker('seekers',$id,true);
            }
                //return null;


        }

        //$randNum = rand(1, 20);
      // if ($randNum > 8) {
            $COUNT = Helpers::ReadData();

        return $COUNT;
        /*}
        return session('data');*/




    }

}
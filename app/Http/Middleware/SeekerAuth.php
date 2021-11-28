<?php
/**
 * Created by PhpStorm.
 * User: Asasna
 * Date: 06/09/2017
 * Time: 10:34 م
 */

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Helpers;


class SeekerAuth
{
    public function handle($request, Closure $next, $guard = 'users')
    {




        // if (!$request->session()->has('seeker_id')) {
        if (! Auth::guard($guard)->check()) {


            if (Auth::guard($guard)->guest()){

                if ($request->ajax()) {
                    return response('Unauthorized.', 401);
                } else {
                    $seekers = auth()->guard('users');
                    Session::flush();

                    $seekers->logout();

                    return redirect()->guest('/login');
                }
            }else{


                $id=    Auth::guard($guard)->user()->seeker_id;
                 if($id == null){
                    $seekers =  Auth::guard($guard)->user();
                    Session::flush();

                    $seekers->logout();
                    // return redirect('/login');

                    return redirect('/login');
                }
                Helpers::getDataSeeker('seekers',$id,true);
            }

        }/*else if( (!$request->session()->has('seeker_id'))){
             $seekers = auth()->guard('users');
             Session::flush();

             $seekers->logout();
         }*/


        /*if ($request->session()->has('seeker')) {
            return redirect('/profile');
        }*/

        return $next($request);
    }
}


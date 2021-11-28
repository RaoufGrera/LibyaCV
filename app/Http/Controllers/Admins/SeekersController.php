<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class SeekersController extends Controller
{
    public function showAllSeeker(){


        if(!empty($_GET['page'])){ $page = (int) $_GET['page']; }else{ $page =1; }

        $records_at_page = 80;
        $queryCount = DB::table('seekers')->count();

        $recodes_count = $queryCount;

        $page_count = (int) ceil($recodes_count / $records_at_page );

        if($recodes_count <> 0){
            if(($page > $page_count) || ($page <= 0)){
                die('خطاء');
            }}

        $start= ($page -1) * $records_at_page;
        $end = $records_at_page;




        $allSeekers = DB::table('seekers');
        if($end !=NULL ){
            $allSeekers =$allSeekers->select('seeker_id','user_name','phone','block_admin','email','fname','lname','confirmed')->take($end)->skip($start);
        }
        $allSeekers =$allSeekers->get();

        return view('admins.seekerControl.all-seekers')
            ->with('allSeekers',$allSeekers)
            ->with('page_count',$page_count);

    }

    public function showSeeker($user){

        $seeker = DB::table('seekers')->where('user_name',$user)->first();
        return view('admins.seekerControl.seeker')
            ->with('seeker',$seeker)->with('user',$user);

    }

    public function blockAdmin(Request $request,$user){
        $blockAdmin = $request->input('block_admin');
         DB::table('seekers')->where('user_name',$user)->update([
             'block_admin' => $blockAdmin,
         ]);
        return redirect('/administrator/seeker/'.$user);
    }

    public function confirmed(Request $request,$user){
        $confirmed = $request->input('confirmed');
        DB::table('seekers')->where('user_name',$user)->update([
            'confirmed' => $confirmed,
        ]);
        return redirect('/administrator/seeker/'.$user);
    }

}

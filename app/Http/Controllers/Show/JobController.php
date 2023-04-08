<?php

namespace App\Http\Controllers\Show;

use Auth;
use Illuminate\Http\Request;
use DB;
use App\Helpers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    //
    public function index($desc_id,$name ="")
    {



        $seeker_id = session('seeker_id');

        $job = DB::table('job_description')
            ->select(
                'job_description.desc_id',
                'job_description.domain_id',
                'job_description.city_id',
                'job_name',
                'managers.manager_id',
                'level',
                'companys.comp_id',
                'comp_user_name',
                'comp_name',
                'job_start',
                'job_end',
                DB::raw('COUNT(DISTINCT job_seeker_req.seeker_id) AS req_count'),
                'job_desc',
                'how_receive',
                'job_description.email',
                'job_description.phone',
                'job_description.website',
                'job_description.see_it',
                'image',
                'code_image',
                'job_city.city_name',
                'job_domain.domain_name',
                'compt_name'
            )
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
            ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
            ->leftJoin('job_seeker_req', 'job_seeker_req.desc_id', '=', 'job_description.desc_id') //error
            ->join('job_domain', 'job_domain.domain_id', '=', 'job_description.domain_id')
            ->join('job_city', 'job_city.city_id', '=', 'job_description.city_id')
            //    ->leftJoin('job_type', 'job_type.type_id', '=', 'job_description.type_id')
            //  ->leftJoin('job_edt', 'job_edt.edt_id', '=', 'job_description.edt_id')
            // ->leftJoin('job_status', 'job_status.status_id', '=', 'job_description.status_id')
            //->leftJoin('job_nat', 'job_nat.nat_id', '=', 'job_description.nat_id')
            ->where('job_description.desc_id', '=', $desc_id)
            //   ->where('job_description.job_end', '>=', NOW())
            ->where('managers.block_admin', 0)
            ->where('job_description.block_admin', 0)
            ->groupby('job_description.desc_id')
            ->first();

        if($name == null || $name==""){
            $separator="-";
            $string = trim($job->job_name);
            $string = mb_strtolower($string, 'UTF-8');
            $string = preg_replace("/[^a-z0-9_\s\-ءاآؤئليةبپتثجچحخدذرزسشصضطظعغفقكکگلمنوهی]/u", '', $string);
            $string = preg_replace("/[\s\-_]+/", ' ', $string);
            $string = preg_replace("/[\s_]/", $separator, $string);


           return redirect("/job/".$desc_id."/".$string);
        }
        if ($job == null)
            return view('errors.404');

        $isreq = DB::table('job_seeker_req')
            ->where('desc_id', $desc_id)
            ->where('seeker_id', $seeker_id)
            ->first();

        $randNum = rand(1, 20);
        //   if($randNum  > 8) {
        DB::table('job_description')
            ->where('desc_id', $desc_id)
            ->update(['see_it' => DB::raw('see_it+1')]);
        // }
        //    $myCompany = Helpers::getDataSeeker('seekerCompany',$seeker_id,false);

        $otherJob = "";
        $jobsArray = array();
        if ($job != null) {
            $otherJob = DB::table('job_description')
                ->select(
                    'job_description.desc_id',
                    'job_name',
                    'companys.comp_id',
                    'comp_user_name',
                    'comp_name',
                    'job_desc',
                    'desc_down',
                    'job_start',
                    'job_end',
                    'desc_down',
                    'job_description.see_it',
                    'image',
                    'code_image',
                    'job_city.city_name',
                    'job_domain.domain_name'
                )
                ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
                ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
                ->join('job_domain', 'job_domain.domain_id', '=', 'job_description.domain_id')
                ->join('job_city', 'job_city.city_id', '=', 'job_description.city_id')
              //  ->where('managers.block_admin', 0)
              //  ->where('job_description.desc_id', '!=', $desc_id)
         //       ->where('job_description.block_admin', 0)
                //  ->where('job_description.job_end', '>=', NOW())
            //    ->where('job_description.city_id', $job->city_id)
           //     ->where('job_description.domain_id', $job->domain_id)
                /*  ->where(function($query) use ($job){
               $query->where('job_description.city_id',$job->city_id);
               $query->orWhere('job_description.domain_id',$job->domain_id);
           })*/
                ->orderby('desc_down')

                ->take(9)
                ->get();

            $jobColor['طرابلس'] = "greencity";
            $jobColor['بنغازي'] = "bluecity";
            $jobColor['مصراته'] = "redcity";
            $jobColor['الزاوية'] = "blackcity";
            $jobColor['الخمس'] = "blackcity";
            $jobColor['زليتن'] = "blackcity";
            $jobColor['سبها'] = "blackcity";
            $jobColor['ترهونة'] = "blackcity";
            $jobColor['غريان'] = "blackcity";
            $jobColor['البيضاء'] = "blackcity";


            foreach ($otherJob as $item){
                $jobsArray[$item->desc_id] =
                    array(
                        'job_name' => $item->job_name,
                        'desc_id' => $item->desc_id,
                        'comp_name' => $item->comp_name,
                        'city_color' => $jobColor[$item->city_name],

                        'image' => $item->image,
                        'code_image' => $item->code_image,
                        'comp_user_name' => $item->comp_user_name,
                        'domain_name' => $item->domain_name,
                        'city_name' => $item->city_name,
                        // 'req_count' => $jobArr[$t]->req_count,
                        'see_it' => $item->see_it,
                        'job_end' => $item->job_end,
                        'job_start' => $item->job_start
                    );
            }


        }

        return view('show.job')
            //   ->with('myCompany', $myCompany)
            ->with('id', $desc_id)
            ->with('isreq', $isreq)
            ->with('otherJob', $jobsArray)
            ->with('desc_id', $desc_id)
            ->with('job', $job);
    }

    public function update(Request $request, $id)
    {
        $seeker_id = session('seeker_id');

        $lastReq = DB::table('job_seeker_req')
            ->where('seeker_id', $seeker_id)
            ->where('desc_id', $id)
            ->first();
        if ($lastReq != null) {
            if (strtotime($lastReq->created_at) < strtotime('-59 second')) {
                DB::table('job_seeker_req')
                    ->where('desc_id', $id)
                    ->where('seeker_id', $seeker_id)
                    ->delete();
            } else {
                return response()->json([
                    'count' => 'e',
                    'check' => true,
                ]);
            }


            $req_count = DB::table('job_seeker_req')
                ->where('desc_id', $id)
                ->count();
            $ch = false;

            return response()->json([
                'check' => $ch,
                'requests' => $req_count,
            ]);
        }





        DB::table('job_seeker_req')->insert([
            'seeker_id' => $seeker_id,
            'desc_id' => $id,
            'req_date' => date("Y-m-d"),
            'match' => 0,
            'created_at' => \Carbon\Carbon::now(),
        ]);



        $req_count = DB::table('job_seeker_req')
            ->select(DB::raw('COUNT(DISTINCT job_seeker_req.seeker_id) AS req_count'))
            ->where('desc_id', $id)
            ->first();

        $ch = true;


        return response()->json([
            'check' => $ch,
            'requests' => $req_count->req_count,
        ]);
    }

    public function destroy($id)
    {
        $seeker_id  = session('seeker_id');
        DB::table('job_seeker_req')
            ->where('desc_id', $id)
            ->where('seeker_id', $seeker_id)
            ->delete();
        return redirect('/job/' . $id);
    }
}

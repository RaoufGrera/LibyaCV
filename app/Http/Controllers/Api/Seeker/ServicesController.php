<?php
namespace App\Http\Controllers\Api\Seeker;

use App\Desc;
use App\Helpers;
use App\Http\Controllers\Controller;
use App\Jobs\NoteAddJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
 use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;


class ServicesController extends Controller
{
    public function index(){
        $seeker_id = Auth::user()->seeker_id;

        if(!empty($_GET['page'])){ $page = (int) $_GET['page']; }else{ $page =1; }
        $records_at_page = 10;
        $start= ($page -1) * $records_at_page;
        $end = $records_at_page;
        $data['start'] = $start;
        $data['end'] = $end;

        $jobs = DB::table('services')
            ->join('seekers','seekers.seeker_id','=','services.seeker_id')
            ->join('job_city','job_city.city_id','=','services.city_id')
            ->join('job_domain','job_domain.domain_id','=','services.domain_id')
            ->select('services_id','gender','about','title','body','user_name','fname','city_name','image','code_image', 'domain_name','address' )
            ->where('services.seeker_id', $seeker_id)
            ->take($end)
            ->skip($start)
            ->get();



        $jobsArray = array();
        if($jobs != null) {
            foreach ($jobs as $job) {

                $jobsArray[$job->services_id] =
                    array(
                        "desc_id"=>$job->services_id,
                        "job_name"=>$job->title ,
                        'see_it' => 0,
                        'type'=>"movie",
                    );
            }
            $lastjob = array();

            $i =0;
            foreach($jobsArray as $dd){


                $lastjob[]=$dd;
                $i++;
            }
            $jobsArray=$lastjob;
        }
        return response()->json(
            $jobsArray
            ,200,[],JSON_NUMERIC_CHECK);


    }

    public function create()
    {


        $domain = Helpers::getDataSeeker('job_domain', null, false);
        $city = Helpers::getDataSeeker('job_city', null, false);
        //     $company = Helpers::getDataSeeker('seekerCompany', $user, false);


        return response()->json([
            'domain' =>$domain,
            'city' =>$city
        ], 200);

    }


    public function store(Request $request)
    {

         $id = Auth::user()->seeker_id;

        $city_name = trim(strip_tags($request->input('city_id')));
        $domain_name = trim(strip_tags($request->input('domain_id')));

        $job_name = trim(strip_tags($request->input('job_name')));
        $job_desc = trim(strip_tags($request->input('job_desc')));





        $domainTable = Helpers::getDataSeeker('job_domain',null,false);
        $domain_id = "";
        foreach( $domainTable as $obj ) {
            if (  $obj->domain_name == $domain_name  ) {
                $domain_id = $obj->domain_id;
                break;
            }
        }

        $edtTable = Helpers::getDataSeeker('job_city',null,false);
        $city_id = "";
        foreach( $edtTable as $obj ) {
            if (  $obj->city_name == $city_name  ) {
                $city_id = $obj->city_id;
                break;
            }
        }

        DB::table('services')->insert([
            'seeker_id' => $id,
            'city_id' => $city_id ,
            'domain_id' => $domain_id,
            'title' => $job_name,
            'body' => $job_desc,

        ]);



        return response()->json(['message'=>Helpers::getMessage("saved")], 200);

    }

    public function show($id)
    {

    }


    public function edit($id)
    {

        $seekers_id = Auth::user()->seeker_id;

        $domain = Helpers::getDataSeeker('job_domain', null, false);
        $city = Helpers::getDataSeeker('job_city', null, false);

        $services = DB::table("services")
            ->join('job_domain', 'job_domain.domain_id', '=', 'services.domain_id')
            ->join('job_city', 'job_city.city_id', '=', 'services.city_id')
            ->where('seeker_id','=',$seekers_id)
            ->where('services_id','=',$id)
            ->first();

        $services->job_desc = $services->body;
        $services->job_name = $services->title;


        return response()->json([
            'job' =>$services,
            'domain' =>$domain,
            'city' =>$city
        ], 200);
    }

    public function update(Request $request, $id)
    {


        $seeker_id =Auth::user()->seeker_id;


        $job_name = trim(strip_tags($request->input('job_name')));
        $job_desc = trim(strip_tags($request->input('job_desc')));

        $city_name = trim(strip_tags($request->input('city_id')));
        $domain_name = trim(strip_tags($request->input('domain_id')));


        $domainTable = Helpers::getDataSeeker('job_domain',null,false);
        $domain_id = "";
        foreach( $domainTable as $obj ) {
            if (  $obj->domain_name == $domain_name  ) {
                $domain_id = $obj->domain_id;
                break;
            }
        }

        $edtTable = Helpers::getDataSeeker('job_city',null,false);
        $city_id = "";
        foreach( $edtTable as $obj ) {
            if (  $obj->city_name == $city_name  ) {
                $city_id = $obj->city_id;
                break;
            }
        }


        DB::table('services')
            ->where('services_id', $id)
            ->where('seeker_id', $seeker_id)->update([
                'city_id' => $city_id ,
                'domain_id' => $domain_id,
                'title' => $job_name,
                'body' => $job_desc,
            ]);


        return response()->json(['message'=>Helpers::getMessage("saved")], 200);


    }

    public function destroy($id)
    {
        $seeker_id =Auth::user()->seeker_id;

        $id = trim($id);


        DB::table('services')
            ->where('services_id',$id)
            ->where('seeker_id',$seeker_id)
            ->delete();


        return response()->json(['message'=>Helpers::getMessage("saved")], 200);

    }

}
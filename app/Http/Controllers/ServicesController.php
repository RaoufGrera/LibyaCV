<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\MainHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ServicesController extends Controller
{
    //
    private $pageName;

    public function __construct()
    {
        $this->pageName = "se";

    }

    public function index(){
        $seeker_id = session('seeker_id');

        $services = DB::table("services")
            ->join('seekers','seekers.seeker_id','=','services.seeker_id')
            ->join('job_city','job_city.city_id','=','services.city_id')
            ->join('job_domain','job_domain.domain_id','=','services.domain_id')
            ->where('services.seeker_id','=',$seeker_id)
            ->get();

        return view('seekers.services')
            ->with('services',$services);
    }
    public function create()
    {


        $city = Helpers::getDataSeeker('job_city',null,false);
        $domain_type = Helpers::getDataSeeker('job_domain',null,false);

        return view('seekers.modal.add.ase')
            ->with('city',$city)
            ->with('domain_type',$domain_type);
    }


    public function store(Request $request)
    {

        $id = session('seeker_id');

        $validator = Validator::make(Input::all(), [
            'dom_name' => 'required|exists:job_domain,domain_id|max:60',
            'city_name' => 'required|exists:job_city,city_id',
             'body' => 'required',
            'title' => 'required',
         ]);
        if ($validator->fails()) {

            $services = DB::table("services")
                ->join('seekers','seekers.seeker_id','=','services.seeker_id')
                ->join('job_city','job_city.city_id','=','services.city_id')
                ->join('job_domain','job_domain.domain_id','=','services.domain_id')
                ->where('services.seeker_id','=',$id)
                ->get();
            $data = ["$services" => $services,];
            $message = "";


            return  Helpers::showModal($this->pageName,$data,$message);
        }

        $city_name = trim(strip_tags($request->input('city_name')));
        $dom_name = trim(strip_tags($request->input('dom_name')));






        $title = $request->input('title');
        $body = $request->input('body');




        DB::table('services')->insert([
            'seeker_id' => $id,
            'city_id' => $city_name ,
            'domain_id' => $dom_name,
            'title' => $title,
            'body' => $body,

        ]);



        $services = DB::table("services")
            ->join('seekers','seekers.seeker_id','=','services.seeker_id')
            ->join('job_city','job_city.city_id','=','services.city_id')
            ->join('job_domain','job_domain.domain_id','=','services.domain_id')
            ->where('services.seeker_id','=',$id)
            ->get();

        $data = [
            "services" => $services,
        ];
        $message = "تمت العملية بنجاح.";

        return  Helpers::showModal($this->pageName,$data,$message);
    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        $seekers_id = Session::get('seeker_id');


        $city = Helpers::getDataSeeker('job_city',null,false);
        $domain_type = Helpers::getDataSeeker('job_domain',null,false);

        $services = DB::table("services")
            ->where('seeker_id','=',$seekers_id)
            ->where('services_id','=',$id)
            ->first();



        return view('seekers.modal.edit.ese')
            ->with('services',$services)
            ->with('city',$city)
            ->with('domain_type',$domain_type);
    }

    public function update(Request $request, $id)
    {


        $seekers_id = Session::get('seeker_id');




        $validator = Validator::make(Input::all(), [
            'dom_name' => 'required|exists:job_domain,domain_id|max:60',
            'city_name' => 'required|exists:job_city,city_id',
             'body' => 'required',
            'title' => 'required',
        ]);
        if ($validator->fails()) {

            $services = DB::table("services")
                ->join('seekers','seekers.seeker_id','=','services.seeker_id')
                ->join('job_city','job_city.city_id','=','services.city_id')
                ->join('job_domain','job_domain.domain_id','=','services.domain_id')
                ->where('services.seeker_id','=',$seekers_id)
                ->get();
            $data = ["services" => $services,];
            $message = "";


            return  Helpers::showModal($this->pageName,$data,$message);
        }

        $city_name = trim(strip_tags($request->input('city_name')));
        $dom_name = trim(strip_tags($request->input('dom_name')));






        $title = $request->input('title');
        $body = $request->input('body');







                DB::table('services')
                    ->where('services_id', $id)
                    ->where('seeker_id', $seekers_id)->update([
                        'city_id' => $city_name ,
                        'domain_id' => $dom_name,
                        'title' => $title,
                        'body' => $body,
                    ]);


        $services = DB::table("services")
            ->join('seekers','seekers.seeker_id','=','services.seeker_id')
            ->join('job_city','job_city.city_id','=','services.city_id')
            ->join('job_domain','job_domain.domain_id','=','services.domain_id')
            ->where('services.seeker_id','=',$seekers_id)
            ->get();

        $data = [
            "services" => $services,
        ];
        $message = "";

        return  Helpers::showModal($this->pageName,$data,$message);
    }

    public function destroy($id)
    {
        $seekers_id = Session::get('seeker_id');

        $id = trim($id);


        DB::table('services')
            ->where('services_id',$id)
            ->where('seeker_id',$seekers_id)
            ->delete();


        $services = DB::table("services")
            ->join('seekers','seekers.seeker_id','=','services.seeker_id')
            ->join('job_city','job_city.city_id','=','services.city_id')
            ->join('job_domain','job_domain.domain_id','=','services.domain_id')
            ->where('services.seeker_id','=',$seekers_id)
            ->get();


        $data = [
            "services" => $services,
        ];
        $message = "";

        return  Helpers::showModal($this->pageName,$data,$message);
    }

    public function getCustomer(){
        $dd = MainHelper::Services();
/*            $res = $client->get($url);


            $GuzzleArr = json_decode($res->getBody(), true);

            if($GuzzleArr["phoneNumber"]){
                dump("not have");

            }*/
        dd($dd);
        return response()->json($dd , 200, [], JSON_NUMERIC_CHECK);

    }
    public function saveCustomer1()
    {
        $client = new \GuzzleHttp\Client();

        for ($i =21; $i <25; $i++) {
         //   $urls = "http://esoft.ly/api/Customer/getCustomer/" . $i . "/?key=AAAAAA";
            $urls = "http://esoft.ly/api/Service/getCustomerServices/" . $i . "/?key=AAAAAA";
       /*   $urls = 'http://esoft.ly/api/Service/changeServiceProviderDescription/'.$i.'/"%D8%B3%D9%83%D8%B3%20%D8%A7%D9%84%D9%84%D9%8A%D9%84%D9%8A"?key=AAAAAA';*/


            $res = $client->get($urls);
            $GuzzleArr = json_decode($res->getBody(), true);



            dump($GuzzleArr);
        }

    }
    public function saveCustomer(){
         $client = new \GuzzleHttp\Client();

        for($i=3;$i<30;$i++){



            $url = "http://esoft.ly/api/Customer/update/?key=AAAAAA";

             $r = $client->request('POST', $url, [  'json' => [

       "id"=> $i,
      "fullName"=> "1",
      "profileImage"=> "",
      "isEnabled"=> false,
      "description"=> "",
      "isDeleted"=> false,
      "token"=> null,
      "streetId"=> null,
      "customerComments"=> null,
      "customerComplaints"=> null,
      "customerRates"=> null,
      "serviceProviders"=> null,
      "serviceProviders1"=> null]]);


            dump("this is ".$i);


        }

       // return response()->json("Ok" , 200, [], JSON_NUMERIC_CHECK);

    }
    public function changeCustomer(){
        $client = new \GuzzleHttp\Client();


       // for($i=3;$i<200;$i++){
            //if($i % 2){
             //   $jone= "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";
           // }else{
                $jone= "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";

           // }

            $r = $client->request('POST', "http://esoft.ly/api/Customer/upload?key=AAAAAA", [  'json' => [


                "id"=> "57",
                "base64Image"=> $jone,

            ]
            ]);




       // }
        // return response()->json("Ok" , 200, [], JSON_NUMERIC_CHECK);

    }
}

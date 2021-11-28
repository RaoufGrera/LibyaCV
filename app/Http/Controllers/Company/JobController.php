<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\easyphpthumbnail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class JobController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
    }


    public function create()
    {

        $domain= Helpers::getDataSeeker('job_domain',null,false);
        $city =Helpers::getDataSeeker('job_city',null,false);

        $compt= $type = Helpers::getDataSeeker('job_comp_type',null,false);
        return view('company.create.company')
            ->with('compt',$compt)
            ->with('domain',$domain)
            ->with('type',$type)
            ->with('city',$city);
    }

    public function update(Request $request,$id)
    {
        $seeker_id = session('seeker_id');

        DB::table('job_seeker_req')->insert([
            'seeker_id' => $seeker_id,
            'desc_id' => $id,
            'date' => date("Y-m-d"),
        ]);
        return redirect('/job/'.$id);

    }
        public function store(Request $request)
    {


        $seeker_id = session('seeker_id');
        $comp_name = $request->input('comp_name');



        $comp_user_name = $request->input('comp_user_name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $url = $request->input('url');
        $address = $request->input('address');
        $city_id = $request->input('city_id');
        $domain_id = $request->input('domain_id');
        $compt_id = $request->input('compt_id');

        if(empty($comp_name)) {
            $error  = "خطاء في الأدخال.";
            return redirect('/create-company')
                ->with('error',$error);
        }

        DB::table('companys')->insert([
            'comp_name' => $comp_name,
            'comp_user_name' => $comp_user_name,
            'email' => $email,
            'phone' => $phone,
            'url' => $url,
            'address' => $address,
            'city_id' => $city_id,
            'domain_id' => $domain_id,
            'compt_id' => $compt_id,
        ]);

        $company_id =  DB::table('companys')
            ->select('comp_id')
            ->where('comp_user_name','=',$comp_user_name)
            ->first();

        DB::table('managers')->insert([
            'comp_id' => $company_id->comp_id,
            'seeker_id' => $seeker_id,
            'level'     =>  'a',
        ]);



        return redirect('company/'.$comp_user_name);
    }

    public function showing($user){
        $seeker_id = session('seeker_id');

        $company= Helpers::getDataSeeker('seekerCompany',$seeker_id,false);



        return view('company.profileCompany')
           ->with('user',$user)
           ->with('myCompany',$company)
           ->with('company',$company);
    }

    public function editInfoCompany($user){

        $seeker_id = session('seeker_id');

        $company= Helpers::getDataSeeker('seekerCompany',$seeker_id,false);

        $domain_type= Helpers::getDataSeeker('job_domain',null,false);
        $city =Helpers::getDataSeeker('job_city',null,false);

        $type = Helpers::getDataSeeker('job_comp_type',null,false);



        return view('company.modal.edit.einfocompany')
            ->with('company',$company)
            ->with('domain_type',$domain_type)
            ->with('type',$type)
            ->with('city',$city);

    }

    public function updateInfoCompany(Request $request,$user){


        $seeker_id = session('seeker_id');
            $comp_name = $request->input('comp_name');

            $email = $request->input('email');
            $phone = $request->input('phone');
            $url = $request->input('url');
            $address = $request->input('address');
            $city_id = $request->input('city_id');
            $domain_id = $request->input('domain_id');
            $compt_id = $request->input('compt_id');

            if(empty($comp_name)) {
                $error  = "خطاء في الأدخال.";
                return redirect('company/'.$user)
                    ->with('error',$error);
            }

            DB::table('companys')
                ->join('managers','managers.comp_id','=','companys.comp_id')
                ->where('managers.seeker_id',$seeker_id)
                ->where('comp_user_name',$user)
                ->update([
                'comp_name' => $comp_name,
                'email' => $email,
                'phone' => $phone,
                'url' => $url,
                'address' => $address,
                'city_id' => $city_id,
                'domain_id' => $domain_id,
                'compt_id' => $compt_id,
            ]);
            return redirect('company/'.$user);
    }

    public function editMapCompany($user){
        $seeker_id = session('seeker_id');

        $myCompany =  Helpers::getDataSeeker('seekerCompany',$seeker_id,false);



        return view('company.modal.edit.emapcompany')
            ->with('company',$myCompany)
            ->with('myCompany',$myCompany);

    }

    public function updateMapCompany(Request $request,$user){

        $seeker_id = session('seeker_id');
        $lat = $request->input('lat');
        $lng = $request->input('lng');

        DB::table('companys')
          //  ->where('seeker_id',$seeker_id)
            ->where('comp_user_name',$user)
            ->update([
                'lat' => $lat,
                'lng' => $lng,
            ]);
        return redirect('company/'.$user);
    }

    public function editImageCompany($user){
        $seeker_id = session('seeker_id');

       $myCompany =  Helpers::getDataSeeker('seekerCompany',$seeker_id,false);


        return view('company.modal.edit.eimagecompany')
            ->with('company',$myCompany)
            ->with('myCompany',$myCompany);

    }

    public function updateImageCompany(Request $request,$user){

        $seeker_id = session('seeker_id');

        if($request->file('image') == NULL)
            $imageType = NULL;
        else
            $imageType =  $request->file('image')->getClientOriginalExtension();


        if ((  ($imageType == "jpeg")
                || ($imageType == "jpg")
                || ($imageType == "png"))
            && ($request->file('image')->getSize() < 100000))
              { // لايكون حجم الصورة أكثر من 200 كيلو بايت

            $imageName = $seeker_id . '.' .
                $imageType;




            $filename = base_path() . '/public/images/company/'.$imageName;
            if (file_exists($filename)) {
                if(!unlink($filename)){
                    die("حدث خطاء أثناء حذف الصورة القديمة");
                }

            }

            $request->file('image')->move(
                base_path() . '/public/images/company/', $imageName
            );

            if (file_exists($filename)) {

                $thumb = new easyphpthumbnail();
                $thumb -> Thumbsize = 180;
                $filefull = base_path() . '/public/images/size';
                $thumb -> Createthumb($filename,'file');
                $thumb =  base_path() . '/public/'.$imageName;

                DB::table('companys')
                    ->join('managers','managers.comp_id','=','companys.comp_id')
                    ->where('managers.seeker_id',$seeker_id)
                    ->where('comp_user_name',$user)
                    ->update([
                        'image' => $imageName,

                    ]);

                if(copy($thumb,$filename)){
                    !unlink($thumb);

                }

            }
        }else{
            return redirect('company/'.$user.'#');


        }
        return redirect('company/'.$user);


    }
}


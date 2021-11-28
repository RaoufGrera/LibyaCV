<?php

namespace App\Http\Controllers\Api\Company;

use App\easyphpthumbnail;
use App\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;

class CompanyController extends Controller
{


    public function index()
    {
        $seekers_id = Auth::user()->seeker_id;

        $company = DB::table('seekers')->select('user_name_company')->where('seeker_id', $seekers_id)->first();

        $companyArr[0] = null;
        if ($company != null) {
            if (trim($company->user_name_company) != "" && $company->user_name_company != null) {
                $companyArr[0] =$company->user_name_company;
               /* $compArr = explode("+", $company->user_name_company);
                $i = 0;
                foreach ($compArr as $item) {
                    $companyArr[$i] = $item;
                    $i++;
                }*/
            }
        }
        return response()->json($companyArr, 200);

    }

    public function createCompany()
    {
        $domain = Helpers::getDataSeeker('job_domain', null, false);
        $city = Helpers::getDataSeeker('job_city', null, false);
        $type = Helpers::getDataSeeker('job_comp_type', null, false);
        return response()->json([
            'city' => $city,
            'type' => $type,
            'domain' => $domain
        ], 200);
    }

    public function postCompany(Request $request)
    {
        $seeker_id = Auth::user()->seeker_id;
        $objSeeker = DB::table('seekers')
            ->select('user_name_company')
            ->where('seeker_id', $seeker_id)
            ->first();
        if (trim($objSeeker->user_name_company) != "" && $objSeeker->user_name_company != null) {

            $error = "ليس لديك صلاحية انشاء اكثر من شركة.";
            return response()->json(['message' => $error]
                , 200);
        }

        $comp_name = $request->input('comp_name');


        $comp_user_name = $request->input('comp_user_name');
     //   $email = $request->input('email');
       // $phone = $request->input('phone');
        $url = $request->input('url');
        $address = $request->input('address');
        $city_name = $request->input('city_id');
        $domain_name = $request->input('domain_id');
        $compt_name = 1;//$request->input('compt_id');

        $checkHaveCompany = DB::table('managers')
            ->where('seeker_id', $seeker_id)
            ->first();

        if ($checkHaveCompany != null) {
            return response()->json(['message' => Helpers::getMessage("error")]
                , 200);
        }


        $validator = Validator::make(Input::all(), [
            'domain_id' => 'required|exists:job_domain,domain_name|max:255',
            'city_id' => 'required|exists:job_city,city_name',
          //  'compt_id' => 'required|exists:job_comp_type,compt_name',
            'comp_user_name' => 'required|min:3|unique:companys,comp_user_name|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'comp_name' => 'required|min:3|unique:companys,comp_name',
        ]);



        if ($validator->fails()) {
            //dd($city_name);
            return response()->json(['message' => " خطاء في الادخال، أو ان اسم الشركة مستخدم من قبل."]
                , 200);
        }

      /*  $isOKK = preg_match('/^\S*$/u', $comp_name);

        if(!$isOKK)
            return response()->json(['message' => " خطاء في اسم الشركة يرجي كتابة الاسم باللغة الانجليزية وبدون مسافات ورموز."]
                , 200);
*/

        $domain = Helpers::getDataSeeker('job_domain', null, false);
        $domain_id = "";
        foreach ($domain as $item) {
            if ($item->domain_name == $domain_name)
                $domain_id = $item->domain_id;
        }
        $city = Helpers::getDataSeeker('job_city', null, false);

        $city_id = "";
        foreach ($city as $item) {
            if ($item->city_name == $city_name)
                $city_id = $item->city_id;
        }
        $type = Helpers::getDataSeeker('job_comp_type', null, false);

        $compt_id = 1;
        foreach ($type as $item) {
            if ($item->compt_name == $compt_name)
                $compt_id = $item->compt_id;
        }

        $company_id = DB::table('companys')->insertGetId([
            'comp_name' => $comp_name,
            'comp_user_name' => $comp_user_name,

            'url' => $url,
            'address' => $address,
            'city_id' => $city_id,
            'domain_id' => $domain_id,
            'compt_id' => $compt_id,
            'compt_name' => $compt_name,
            'city_name' => $city_name,
            'domain_name' => $domain_name

        ]);


        DB::table('managers')->insert([
            'comp_id' => $company_id,
            'seeker_id' => $seeker_id,
            'level' => 'a',
        ]);

        $objSeeker = DB::table('seekers')
            ->select('user_name_company')
            ->where('seeker_id', $seeker_id)
            ->first();

            DB::table('seekers')
                ->where('seeker_id', $seeker_id)
                ->update([
                    'have_company' => 1,
                    'user_name_company' => $objSeeker->user_name_company . '+' . $comp_user_name
                ]);


        DB::table('seekers')->where('seeker_id', $seeker_id)->update(['user_name_company' => $comp_user_name, 'have_company' => 1]);


        Helpers::getDataSeeker('seekerCompany', $comp_user_name, true);

        Helpers::getDataSeeker('seekers', $seeker_id, true);


        return response()->json(['message' => Helpers::getMessage("saved")], 200);

    }

    public function showCompany($user){
        $dataTable= DB::table('companys')
            ->select('companys.comp_id','comp_name', 'comp_user_name','services','managers.block_admin'
                ,'level','image','code_image','cover','code_cover','see_it',
                'facebook',  'twitter',  'linkedin','website','url','comp_desc'
                ,'lng','lat','address','email','comp_desc','domain_id','city_id','compt_id',
                'phone','managers.seeker_id','domain_name','compt_name','city_name')
            ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
            ->where('companys.comp_user_name', '=', $user)
            ->first();



    }
    public function editInfoCompany()
    {
        $seeker_id = Auth::user()->seeker_id;
        $company= DB::table('companys')
            ->select('companys.comp_id','comp_name', 'comp_user_name','services','managers.block_admin'
                ,'level','image','code_image','cover','code_cover','see_it',
                'facebook',  'twitter',  'linkedin','website','url','comp_desc'
                ,'lng','lat','address','email','comp_desc','domain_id','city_id','compt_id',
                'phone','managers.seeker_id','domain_name','compt_name','city_name')
            ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
            ->where('managers.seeker_id', '=', $seeker_id)
            ->first();
        $actual_link ="https://www.libyacv.com";
        if($company != null)
        $company->image = ($company->image == null || $company->image == "") ? $actual_link.'/images/simple/company.png' :$actual_link.'/images/company/300px_'.$company->code_image.'_'.$company->image;


        $domain = Helpers::getDataSeeker('job_domain', null, false);

        $city = Helpers::getDataSeeker('job_city', null, false);
      //  $type = Helpers::getDataSeeker('job_comp_type', null, false);


        return response()->json([
            'city' => $city,
            'company' => $company,
          //  'type' => $type,

            'domain' => $domain
        ], 200);

    }

    public function updateInfoCompany(Request $request)
    {


        $seeker_id = Auth::user()->seeker_id;
      $comp_name = $request->input('comp_name');


        $email = $request->input('email');
        $phone = $request->input('phone');
        $url = $request->input('url');
        $address = $request->input('address');
        $city_name = $request->input('city_id');
        $domain_name = $request->input('domain_id');
        $compt_name = $request->input('compt_id');
        $comp_desc = $request->input('comp_desc');
         $services = $request->input('services');
        $facebook = $request->input('facebook');
        $twitter = $request->input('twitter');
        $linkedin = $request->input('linkedin');








        $validator = Validator::make(Input::all(), [
            'domain_id' => 'required|exists:job_domain,domain_name|max:255',
            'city_id' => 'required|exists:job_city,city_name',
         ]);

        if ($validator->fails()) {
            return response()->json(['message' => Helpers::getMessage("error")]
                , 200);
        }

        $domain = Helpers::getDataSeeker('job_domain', null, false);
        $domain_id = "";
        foreach ($domain as $item) {
            if ($item->domain_name == $domain_name)
                $domain_id = $item->domain_id;
        }
        $city = Helpers::getDataSeeker('job_city', null, false);

        $city_id = "";
        foreach ($city as $item) {
            if ($item->city_name == $city_name)
                $city_id = $item->city_id;
        }
       /* $type = Helpers::getDataSeeker('job_comp_type', null, false);

        $compt_id = "";
        foreach ($type as $item) {
            if ($item->compt_name == $compt_name)
                $compt_id = $item->compt_id;
        }*/

        $companyName = DB::table('managers')
            ->select('companys.comp_user_name')
            ->join('companys','companys.comp_id','=','managers.comp_id')

            ->where('seeker_id','=',$seeker_id)
            ->first();
        DB::table('companys')
            ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
            ->where('managers.seeker_id', $seeker_id)

            ->update([
                'comp_name' => $comp_name,
                'email' => $email,
                'phone' => $phone,
                'url' => $url,
                'address' => $address,
                'city_id' => $city_id,
                'domain_id' => $domain_id,
                'comp_desc' => $comp_desc,
                 'linkedin' => $linkedin,
                'twitter' => $twitter,
                'facebook' => $facebook,
                'services' => $services,
                'compt_id' => 1,
                'compt_name' => $compt_name,
                'city_name' => $city_name,
                'domain_name' => $domain_name
            ]);

        Helpers::getDataSeeker('seekerCompany', $companyName->comp_user_name, true);

        return response()->json(['message' => Helpers::getMessage("saved")], 200);
    }

    public function updateImageCompany(Request $request)
    {




       // dd($request);
         $seeker_id = Auth::user()->seeker_id;

        //file_get_contents()

        $code = str_random(15);


        $company = DB::table('companys')
            ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
            //  ->join('seekers','seekers.seeker_id','=','managers.seeker_id')
            ->where('managers.seeker_id', $seeker_id)

            ->first();

        $code_image = $company->code_image;

        if ($request->file('file') == NULL)
            $imageType = NULL;
        else
            $imageType = $request->file('file')->getClientOriginalExtension();


        if ((($imageType == "jpeg")
                || ($imageType == "JPEG")
                || ($imageType == "JPG")
                || ($imageType == "jpg")
                || ($imageType == "PNG")
                || ($imageType == "png"))
            && ($request->file('file')->getSize() < 1500000)) { // لايكون حجم الصورة أكثر من 200 كيلو بايت

            $imageName = $company->comp_id . '.jpg';

            $filename300 = base_path() . '/public/images/company/300px_' . $code_image . '_' . $imageName;
            $filename140 = base_path() . '/public/images/company/140px_' . $code_image . '_' . $imageName;
            $filename40 = base_path() . '/public/images/company/40px_' . $code_image . '_' . $imageName;


            if (file_exists($filename300)) {
                if (!unlink($filename300)) {
                    return response()->json(['message' => Helpers::getMessage("error")], 200);
                }

            }
            if (file_exists($filename140)) {
                if (!unlink($filename140)) {
                    return response()->json(['message' => Helpers::getMessage("error")], 200);
                }

            }
            if (file_exists($filename40)) {
                if (!unlink($filename40)) {
                    return response()->json(['message' => Helpers::getMessage("error")], 200);
                }

            }

            $filename = base_path() . '/public/images/company_new/' . '_' . $code . '_' . $imageName;


            $newNameImage = '_' . $code . '_' . $imageName;

            $request->file('file')->move(
                base_path() . '/public/images/company_new/', $newNameImage
            );

            if (file_exists($filename)) {

                $thumb = new easyphpthumbnail();

                $thumb->Thumbsize = 300;

                $thumb->Thumbsaveas = 'jpg';
                $thumb->Thumblocation = 'images/company/300px';
                $thumb->Createthumb($filename, 'file');
                $thumb->Thumbsize = 140;
                $thumb->Thumbsaveas = 'jpg';
                $thumb->Thumblocation = 'images/company/';
                $thumb->Thumbprefix = '140px';
                $thumb->Createthumb($filename, 'file');

                $thumb->Thumbsize = 40;
                $thumb->Thumbsaveas = 'jpg';
                $thumb->Thumblocation = 'images/company/';
                $thumb->Thumbprefix = '40px';
                $thumb->Createthumb($filename, 'file');


                DB::table('companys')
                    ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
                    ->where('managers.seeker_id', $seeker_id)

                    ->update([
                        'image' => $imageName,
                        'code_image' => $code,
                    ]);

            }

            $companyName = DB::table('managers')
                ->join('companys','companys.comp_id','=','managers.comp_id')
                ->select('companys.comp_user_name')
                ->where('seeker_id','=',$seeker_id)
                ->first();
            Helpers::getDataSeeker('seekerCompany', $companyName->comp_user_name, true);

            return response()->json(['message'=>Helpers::getMessage("saved")], 200);

        } else {

            return response()->json(['message'=>"الرجاء استخدام صورة بحجم اقل من 200 Kb"], 200);
        }




    }

    public function getImageCompany( )
    {
        $seeker_id = Auth::user()->seeker_id;

//        $actual_link ="http://192.168.1.6:8081/libyacv/public";
        $actual_link ="https://www.libyacv.com";
        $companyName = DB::table('managers')
            ->join('companys','companys.comp_id','=','managers.comp_id')
            ->select('companys.comp_user_name')
            ->where('seeker_id','=',$seeker_id)
            ->first();
         $myCompany =Helpers::getDataSeeker('seekerCompany', $companyName->comp_user_name, true);
        $image = ($myCompany->image == null || $myCompany->image == "") ? $actual_link.'/images/simple/company.png' :$actual_link.'/images/company/300px_'.$myCompany->code_image.'_'.$myCompany->image;


        return response()->json(['message'=>$image], 200);

    }

    public function editMapCompany($user)
    {
        $company = Helpers::getDataSeeker('seekerCompany', $user, false);
         ($company->lat == "" || $company->lat == null)? $latlng = "" : $latlng = $company->lat.":".$company->lng;
        return response()->json($latlng, 200);
    }

    public function updateMapCompany(Request $request)
    {
        $seeker_id = Auth::user()->seeker_id;

        $companyName = DB::table('managers')
            ->join('companys','companys.comp_id','=','managers.comp_id')
            ->select('companys.comp_user_name')
            ->where('seeker_id','=',$seeker_id)
            ->first();
        $lat = $request->input('lat');
        $lng = $request->input('lng');

        $myCompany = Helpers::getDataSeeker('seekerCompany', $companyName->comp_user_name, false);

        if (empty($myCompany))
            return response()->json(["message"=> Helpers::getMessage("error")], 200);

        DB::table('companys')
            //  ->where('seeker_id',$seeker_id)
            ->where('comp_user_name', $companyName->comp_user_name)
            ->update([
                'lat' => $lat,
                'lng' => $lng,
            ]);
          Helpers::getDataSeeker('seekerCompany', $companyName->comp_user_name, true);
         return response()->json(['message'=>Helpers::getMessage("saved")], 200);
    }





}

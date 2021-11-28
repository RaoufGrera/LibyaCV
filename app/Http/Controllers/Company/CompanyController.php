<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\easyphpthumbnail;
use App\Http\Requests;
use App\Helpers;
use Intervention\Image\Facades\Image;
use Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
    }


    public function create()
    {
        $seeker_id = session('seeker_id');
        $objSeeker = DB::table('seekers')
            ->select('user_name_company')
            ->where('seeker_id', $seeker_id)
            ->first();
        if (trim($objSeeker->user_name_company) != "" && $objSeeker->user_name_company != null) {

            $error = "ليس لديك صلاحية انشاء اكثر من شركة.";
            return redirect('/profile/dashboard')
                ->with('error', $error);
        }


       /* if (session('have_company') != 4)
            return redirect('/create-company')
                ->with('error', "الموقع يسمح بإضافة شركة واحدة فقط لكل حساب.");
*/
        $domain = Helpers::getDataSeeker('job_domain', null, false);
        $city = Helpers::getDataSeeker('job_city', null, false);
         return view('company.create.company')
            ->with('domain', $domain)

            ->with('city', $city);
    }

    public function store(Request $request)
    {


        $seeker_id = session('seeker_id');
        $objSeeker = DB::table('seekers')
            ->select('user_name_company')
            ->where('seeker_id', $seeker_id)
            ->first();
        if (trim($objSeeker->user_name_company) != "" && $objSeeker->user_name_company != null) {

            $error = "ليس لديك صلاحية انشاء اكثر من شركة.";
            return redirect('/create-company')
                ->with('error', $error);
        }

        $comp_name = $request->input('comp_name');


        $string = $request->input('comp_user_name');
        $string = trim($string);
        $string = mb_strtolower($string, 'UTF-8');
        $string = preg_replace("/[^a-z0-9_\s-ءاآؤئليةبپتثجچحخدذرزسشصضطظعغفقكکگلمنوهی]/u", '', $string);
        $string = preg_replace("/[\s-_]+/", ' ', $string);
        $comp_user_name = preg_replace("/[\s_]/", "-", $string);




         $email ="";
        $phone ="";
        $url = "";
       // $address = $request->input('address');
        $city_id = $request->input('city_id');
        $domain_id = $request->input('domain_id');
        $compt_id = 1;


/*
        if ($checkHaveCompany) != 4) {
            $error = "لايمكنك انشاء اكثر من شركة.";
            return redirect('/create-company')
                ->with('error', $error);
        }*/

        if (empty($comp_name)) {
            $error = "خطاء في الأدخال.";
            return redirect('/create-company')
                ->with('error', $error);
        }

        $validator = Validator::make(Input::all(), [
            'domain_id' => 'required|exists:job_domain,domain_id|max:255',
            'city_id' => 'required|exists:job_city,city_id',
            'comp_user_name'=>'unique:companys,comp_user_name'
        ]);

        if ($validator->fails()) {
            $error = "خطاء في الأدخال.";
            return redirect('/create-company')
                ->with('error', $error);
        }

        $domain = Helpers::getDataSeeker('job_domain', null, false);
        $domain_name = "";
        foreach ($domain as $item) {
            if ($item->domain_id == $domain_id)
                $domain_name = $item->domain_name;
        }
        $city = Helpers::getDataSeeker('job_city', null, false);

        $city_name = "";
        foreach ($city as $item) {
            if ($item->city_id == $city_id)
                $city_name = $item->city_name;
        }



        $company_id = DB::table('companys')->insertGetId([
            'comp_name' => $comp_name,
            'comp_user_name' => $comp_user_name,
             'phone' => $phone,
             'address' => "",
            'city_id' => $city_id,
            'domain_id' => $domain_id,
             'city_name' => $city_name,
            'domain_name' => $domain_name

        ]);


        DB::table('managers')->insert([
            'comp_id' => $company_id,
            'seeker_id' => $seeker_id,
            'level' => 'a',
        ]);




            DB::table('seekers')
                ->where('seeker_id', $seeker_id)
                ->update([
                    'have_company' => 1,
                    'user_name_company' => $comp_user_name
                ]);


       // DB::table('seekers')->where('seeker_id', $seeker_id)->update(['user_name_company' => $comp_user_name, 'have_company' => 1]);
        Helpers::getDataSeeker('seekerCompany', $comp_user_name, true);

        Helpers::getDataSeeker('seekers', $seeker_id, true);
        return redirect('company-profile/' . $comp_user_name);
    }

    public function editDescriptionCompany($user)
    {
        $desc = DB::table('companys')->select('comp_desc')
            ->where('comp_user_name', '=', $user)
            ->first();

        return view('company.modal.edit.desccompany')
            ->with('desc', $desc)
            ->with('user', $user);

    }

    public function updateDescriptionCompany(Request $request, $user)
    {
        $seeker_id = session('seeker_id');
        $comp_desc = $request->input('desc_comp');

        DB::table('companys')
            ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
            ->where('managers.seeker_id', $seeker_id)
            ->where('comp_user_name', $user)
            ->update([
                'comp_desc' => $comp_desc,
            ]);
    $company = Helpers::getDataSeeker('seekerCompany', $user, true);


        $message = "";

        $data = [
            "company" => $company,
            "user" => $user
        ];

        return Helpers::showModalCompany('description', $data, $message);
    }

    public function showing($user)
    {
        $seeker_id = session('seeker_id');


        $myCompany = $company = Helpers::getDataSeeker('seekerCompany', $user, true);


        $company_spec = Helpers::getDataSeeker('spec_company', $company->comp_id, false);


        $myJob = DB::table('job_description')
            ->select('job_description.desc_id', 'job_name', 'companys.comp_id'
                , 'comp_user_name', 'comp_name', 'job_desc', 'job_start', 'job_end'
                , 'job_description.see_it', 'image', 'code_image', 'job_city.city_name', 'job_domain.domain_name')
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
            ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
            ->join('job_domain', 'job_domain.domain_id', '=', 'job_description.domain_id')
            ->join('job_city', 'job_city.city_id', '=', 'job_description.city_id')
            ->where('managers.block_admin', 0)
            ->where('job_description.block_admin', 0)
            ->where('job_description.job_end', '>=', NOW());
        // if($company->level != "a")
        $myJob = $myJob->where('managers.seeker_id', '=', $seeker_id);
        $myJob = $myJob->where('comp_user_name', '=', $user)
            ->where('managers.block_admin', FALSE)
            ->where('job_description.block_admin', FALSE)
            ->get();


        return view('company.profileCompany')
            ->with('user', $user)
            ->with('myJob', $myJob)
            ->with('myCompany', $myCompany)
            ->with('company_spec', $company_spec)
            ->with('company', $company);
    }

    public function editInfoCompany($user)
    {

        $seeker_id = session('seeker_id');

        $company = Helpers::getDataSeeker('seekerCompany', $user, false);


        $domain_type = Helpers::getDataSeeker('job_domain', null, false);

        $city = Helpers::getDataSeeker('job_city', null, false);
       // $type = Helpers::getDataSeeker('job_comp_type', null, false);


        return view('company.modal.edit.einfocompany')
            ->with('company', $company)
            ->with('user', $user)
            ->with('domain_type', $domain_type)
         //   ->with('type', $type)
            ->with('city', $city);

    }
    private function http_check($url) {
        $return = $url;
        if ((!(substr($url, 0, 7) == 'http://')) && (!(substr($url, 0, 8) == 'https://'))) {
            $return = 'https://facebook.com/' . $url;
        }
        return $return;
    }

    private function http_check2($url) {
        $return = $url;
        if ((!(substr($url, 0, 7) == 'http://')) && (!(substr($url, 0, 8) == 'https://'))) {
            $return = 'https://' . $url;
        }
        return $return;
    }
    public function updateInfoCompany(Request $request, $user)
    {


        $seeker_id = session('seeker_id');
        $comp_name = $request->input('comp_name');

        $email = $request->input('email');
        $phone = $request->input('phone');
        $url = $request->input('url');
        $url = $this->http_check2($url);
        $address = $request->input('address');
        $city_id = $request->input('city_id');
        $domain_id = $request->input('domain_id');
        $facebook = $request->input('facebook');

        $facebook =$this->http_check($facebook);
      //  $compt_id = $request->input('compt_id');

        if (empty($comp_name)) {
            $error = "خطاء في الأدخال.";
            return redirect('company-profile/' . $user)
                ->with('error', $error);
        }

        $domain = Helpers::getDataSeeker('job_domain', null, false);
        $domain_name = "";
        foreach ($domain as $item) {
            if ($item->domain_id == $domain_id)
                $domain_name = $item->domain_name;
        }
        $city = Helpers::getDataSeeker('job_city', null, false);

        $city_name = "";
        foreach ($city as $item) {
            if ($item->city_id == $city_id)
                $city_name = $item->city_name;
        }
      /*  $type = Helpers::getDataSeeker('job_comp_type', null, false);

        $compt_name = "";
        foreach ($type as $item) {
            if ($item->compt_id == $compt_id)
                $compt_name = $item->compt_name;
        }
*/
        DB::table('companys')
            ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
            ->where('managers.seeker_id', $seeker_id)
            ->where('comp_user_name', $user)
            ->update([
                'comp_name' => $comp_name,
                'email' => $email,
                'phone' => $phone,
                'url' => $url,
                'address' => $address,
                'city_id' => $city_id,
                'domain_id' => $domain_id,
                'facebook' => $facebook,

                'city_name' => $city_name,
                'domain_name' => $domain_name
            ]);

        $company = Helpers::getDataSeeker('seekerCompany', $user, true);


        $message = "";

        $data = [
            "company" => $company,
            "user" => $user
        ];

        return Helpers::showModalCompany('info', $data, $message);
    }

    public function editMapCompany($user)
    {

        $myCompany = $company = Helpers::getDataSeeker('seekerCompany', $user, false);


        return view('company.modal.edit.emapcompany')
            ->with('company', $myCompany)
            ->with('myCompany', $myCompany);

    }

    public function updateMapCompany(Request $request, $user)
    {

       // $seeker_id = session('seeker_id');
        $lat = $request->input('lat');
        $lng = $request->input('lng');

        $myCompany = Helpers::getDataSeeker('seekerCompany', $user, false);

        if (empty($myCompany))
            return redirect('company-profile/' . $user);

        DB::table('companys')
            //  ->where('seeker_id',$seeker_id)
            ->where('comp_user_name', $user)
            ->update([
                'lat' => $lat,
                'lng' => $lng,
            ]);
        return redirect('company-profile/' . $user);
    }

    public function editImageCompany($user)
    {
        $seeker_id = session('seeker_id');

        $myCompany = DB::table('managers')
            ->where('managers.seeker_id', '=', $seeker_id)
            ->where('level', '=', 'a')
            ->first();
        if (empty($myCompany))
            return redirect('company-profile/' . $user);

        return view('company.modal.edit.eimagecompany')
            ->with('user', $user);

    }

    public function editCoverCompany($user)
    {
        $seeker_id = session('seeker_id');
        $myCompany = DB::table('managers')
            ->where('managers.seeker_id', '=', $seeker_id)
            ->where('level', '=', 'a')
            ->first();
        if (empty($myCompany))
            return redirect('company-profile/' . $user);

        return view('company.modal.edit.ecovercompany')
            ->with('user', $user);
    }

    public function updateImageCompany(Request $request, $user)
    {

        $seeker_id = session('seeker_id');

        $code = str_random(15);


        $company = DB::table('companys')
            ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
            //  ->join('seekers','seekers.seeker_id','=','managers.seeker_id')
            ->where('managers.seeker_id', $seeker_id)
            ->where('companys.comp_user_name', $user)
            ->first();

        $code_image = $company->code_image;

        if ($request->file('image') == NULL)
            $imageType = NULL;
        else
            $imageType = $request->file('image')->getClientOriginalExtension();


        if ((($imageType == "jpeg")
                || ($imageType == "JPEG")
                || ($imageType == "JPG")
                || ($imageType == "jpg")
                || ($imageType == "PNG")
                || ($imageType == "png"))
            && ($request->file('image')->getSize() < 900000)) { // لايكون حجم الصورة أكثر من 200 كيلو بايت

            $imageName = $company->comp_id . '.jpg';

            $filename300 = base_path() . '/public/images/company/300px_' . $code_image . '_' . $imageName;
            $filename140 = base_path() . '/public/images/company/140px_' . $code_image . '_' . $imageName;
            $filename40 = base_path() . '/public/images/company/40px_' . $code_image . '_' . $imageName;


            if (file_exists($filename300)) {
                if (!unlink($filename300)) {
                    die("حدث خطاء أثناء حذف الصورة القديمة");
                }

            }
            if (file_exists($filename140)) {
                if (!unlink($filename140)) {
                    die("حدث خطاء أثناء حذف الصورة القديمة");
                }

            }
            if (file_exists($filename40)) {
                if (!unlink($filename40)) {
                    die("حدث خطاء أثناء حذف الصورة القديمة");
                }

            }

            $filename = base_path() . '/public/images/company_new/' . '_' . $code . '_' . $imageName;


            $newNameImage = '_' . $code . '_' . $imageName;

            $request->file('image')->move(
                base_path() . '/public/images/company_new/', $newNameImage
            );

            if (file_exists($filename)) {
                $jpg = Image::make($filename);
                $img = Image::canvas($jpg->width(), $jpg->height(), '#ffffff');
                $img->insert($jpg,'center');


                $img->resize(300, 300);

                $img->save(base_path() . '/public/images/company/300px'.$newNameImage);
                $img->resize(140, 140);

                $img->save(base_path() . '/public/images/company/140px'.$newNameImage);
                $img->resize(40, 40);

                $img->save(base_path() . '/public/images/company/40px'.$newNameImage);
              /*  $thumb = new easyphpthumbnail();

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
                $thumb->Createthumb($filename, 'file');*/


                DB::table('companys')
                    ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
                    ->where('managers.seeker_id', $seeker_id)
                    ->where('comp_user_name', $user)
                    ->update([
                        'image' => $imageName,
                        'code_image' => $code,
                    ]);

            }
            Helpers::getDataSeeker('seekerCompany', $user, true);

        } else {
            $company = DB::table('companys')
                ->select('image', 'code_image')
                ->where('comp_id', $company->comp_id)
                ->where('comp_user_name', $user)
                ->first();

            $message = "";

            $data = [
                "company" => $company,
                "user" => $user
            ];

            return Helpers::showModalCompany('image', $data, $message);
        }

        $company = DB::table('companys')
            ->select('image', 'code_image')
            ->where('comp_id', $company->comp_id)
            ->where('comp_user_name', $user)
            ->first();

        $message = "";

        $data = [
            "company" => $company,
            "user" => $user
        ];

        return Helpers::showModalCompany('image', $data, $message);


    }

    public function updateCoverCompany(Request $request, $user)
    {

        $seeker_id = session('seeker_id');

        $code = str_random(15);


        $company = Helpers::getDataSeeker('seekerCompany', $user, false);


        $code_image = $company->code_cover;

        if ($request->file('image') == NULL)
            $imageType = NULL;
        else
            $imageType = $request->file('image')->getClientOriginalExtension();


        if ((($imageType == "jpeg")
                || ($imageType == "JPEG")
                || ($imageType == "JPG")
                || ($imageType == "jpg")
                || ($imageType == "PNG")
                || ($imageType == "png"))
            && ($request->file('image')->getSize() < 400000)) { // لايكون حجم الصورة أكثر من 200 كيلو بايت

            $imageName = $company->comp_id . '.jpg';

            $filename = base_path() . '/public/images/cover/' . $code_image . '_' . $imageName;


            if (file_exists($filename)) {
                if (!unlink($filename)) {
                    die("حدث خطاء أثناء حذف الصورة القديمة");
                }

            }

            $filename = base_path() . '/public/images/cover_new/' . $code . '_' . $imageName;


            $newNameImage = $code . '_' . $imageName;

            $request->file('image')->move(
                base_path() . '/public/images/cover_new/', $newNameImage
            );

            if (file_exists($filename)) {

                $thumb = new easyphpthumbnail();

                $thumb->Thumbwidth = 800;
                $thumb->Thumbheight = 270;

                $thumb->Thumbsaveas = 'jpg';
                $thumb->Thumblocation = 'images/cover/';
                $thumb->Createthumb($filename, 'file');

                DB::table('companys')
                    ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
                    ->where('managers.seeker_id', $seeker_id)
                    ->where('comp_user_name', $user)
                    ->update([
                        'cover' => $imageName,
                        'code_cover' => $code,
                    ]);
                Helpers::getDataSeeker('seekerCompany', $user, true);

            }

        } else {
            $company = DB::table('companys')
                ->select('cover', 'code_cover')
                ->where('comp_id', $company->comp_id)
                ->where('comp_user_name', $user)
                ->first();

            $message = "";

            $data = [
                "company" => $company,
                "user" => $user
            ];

            return Helpers::showModalCompany('cover', $data, $message);
        }

        $company = DB::table('companys')
            ->select('cover', 'code_cover')
            ->where('comp_id', $company->comp_id)
            ->where('comp_user_name', $user)
            ->first();

        $message = "";

        $data = [
            "company" => $company,
            "user" => $user
        ];

        return Helpers::showModalCompany('cover', $data, $message);


    }

    public function destroyImageCompany($user)
    {
        $seeker_id = session('seeker_id');
        $checkComp = Helpers::getDataSeeker('seekerCompany', $user, false);


        if (!empty($checkComp)) {
            $code_image = $checkComp->code_image;
            $comp_id = $checkComp->comp_id;
            $imageName = $comp_id . '.jpg';

            $filename300 = base_path() . '/public/images/company/300px_' . $code_image . '_' . $imageName;
            $filename140 = base_path() . '/public/images/company/140px_' . $code_image . '_' . $imageName;
            $filename40 = base_path() . '/public/images/company/40px_' . $code_image . '_' . $imageName;


            if (file_exists($filename300)) {
                if (!unlink($filename300)) {
                    die("حدث خطاء أثناء حذف الصورة القديمة");
                }

            }
            if (file_exists($filename140)) {
                if (!unlink($filename140)) {
                    die("حدث خطاء أثناء حذف الصورة القديمة");
                }

            }
            if (file_exists($filename40)) {
                if (!unlink($filename40)) {
                    die("حدث خطاء أثناء حذف الصورة القديمة");
                }

            }

            DB::table('companys')
                ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
                ->where('managers.seeker_id', $seeker_id)
                ->where('comp_user_name', $user)
                ->update([
                    'image' => '',
                ]);
        }

        $company = Helpers::getDataSeeker('seekerCompany', $user, true);


        $message = "";

        $data = [
            "company" => $company,
            "user" => $user
        ];

        return Helpers::showModalCompany('image', $data, $message);

    }

    public function destroyCoverCompany($user)
    {
        $seeker_id = session('seeker_id');
        $checkComp = Helpers::getDataSeeker('seekerCompany', $user, false);


        if (!empty($checkComp)) {
            $code_image = $checkComp->code_cover;
            $comp_id = $checkComp->comp_id;
            $imageName = $comp_id . '.jpg';
            $filename = base_path() . '/public/images/cover/' . $code_image . '_' . $imageName;

            if (file_exists($filename)) {
                if (!unlink($filename)) {

                }

            }

            DB::table('companys')
                ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
                ->where('managers.seeker_id', $seeker_id)
                ->where('comp_user_name', $user)
                ->update([
                    'cover' => '',
                ]);
        }
        $company = Helpers::getDataSeeker('seekerCompany', $user, true);


        $message = "";

        $data = [
            "company" => $company,
            "user" => $user
        ];

        return Helpers::showModalCompany('cover', $data, $message);

    }

    public function indexServices($user)
    {
        $seeker_id = session('seeker_id');
        $myCompany = Helpers::getDataSeeker('seekerCompany', $user, false);
        $services = "";
        if ($myCompany)
            $services = $myCompany->services;


        if ($seeker_id != $myCompany->seeker_id) {
            return view('company.modal.error');
        }
        return view('company.modal.edit.eservices')
            ->with('user', $user)
            ->with('services', $services);

    }

    public function editMap($user)
    {
        $seeker_id = session('seeker_id');
        $company = Helpers::getDataSeeker('seekerCompany', $user, false);


        if (!isset($company)) {
            return view('company.modal.error');
        }
        return view('company.modal.edit.emap')
            ->with('user', $user)
            ->with('company', $company);

    }

    public function storeMap($user, Request $request)
    {
        $seeker_id = session('seeker_id');

        $lat = $request->input('lat');
        $lng = $request->input('lng');


        if (session('user_name_company') == $user) {

            DB::table('companys')
                ->where('comp_user_name', $user)
                ->update([
                    'lat' => $lat,
                    'lng' => $lng,
                ]);
        }
        $message = "";


        $company = Helpers::getDataSeeker('seekerCompany', $user, true);

        $data = [
            "company" => $company,
            "user" => $user
        ];

        return Helpers::showModalCompany('map', $data, $message);

    }

    public function storeServices($user, Request $request)
    {
        $seeker_id = session('seeker_id');


        $services = trim(strip_tags($request->input('services_text')));
        $message = "";
        DB::table('companys')
            //->where('comp_id', $company->comp_id)
            ->where('comp_user_name', $user)
            ->update([
                'services' => $services
            ]);


        $company = Helpers::getDataSeeker('seekerCompany', $user, true);

        $data = [
            "company" => $company,
            "user" => $user
        ];

        return Helpers::showModalCompany('services', $data, $message);

    }

    public function listUsers($user)
    {

        $allUsers = DB::table('companys')
            ->select('managers.level', 'fname', 'lname', 'manager_id', 'managers.seeker_id')
            ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
            ->join('seekers', 'seekers.seeker_id', '=', 'managers.seeker_id')
            ->where('comp_user_name', $user)
            ->get();
        return view('company.users')->with('allUsers', $allUsers)->with('user', $user);
    }

    public function destroyUser($user, $id)
    {
        $seekers_id = session('seeker_id');
        $id = trim($id);

        if ($seekers_id != $id)

            $objSeeker = DB::table('seekers')
                ->select('user_name_company')
                ->where('seeker_id', $id)
                ->first();

        $objSession = explode("+", $objSeeker->user_name_company);
        $lstCompany = "";

        foreach ($objSession as $item) {
            if ($item != $user) {
                if ($lstCompany == "") {
                    $lstCompany = $item;
                } else {
                    $lstCompany = $lstCompany . "+" . $item;
                }

            }
        }
        DB::table('seekers')
            ->where('seeker_id', $id)
            ->update([
                'user_name_company' => $lstCompany
            ]);

        $objComp = DB::table('companys')
            ->select('comp_id')
            ->where('comp_user_name', $user)->first();

        DB::table('managers')
            ->where('seeker_id', $id)
            ->where('comp_id', $objComp->comp_id)
            ->delete();
        return redirect('/company-profile/users/' . $user);


    }

    public function addUser($user)
    {
        $seekers_id = session('seeker_id');

        $objCompany = DB::table('companys')
            ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
            ->select('companys.comp_id')
            ->where('comp_user_name', $user)
            ->where('managers.seeker_id', $seekers_id)
            ->where('managers.level', 'a')
            ->first();

        $allUser = DB::table('seekers')
            ->join('managers', 'managers.seeker_id', '=', 'seekers.seeker_id')
            ->join('followers_seeker', 'followers_seeker.seeker_id', '=', 'seekers.seeker_id')
            ->where('followers_seeker_id', $seekers_id)
            ->where('followers_seeker.seeker_id', '!=', $seekers_id)
            ->where('managers.comp_id', '!=', $objCompany->comp_id)
            ->get();

        return view('company.modal.add.auser')
            ->with('user', $user)
            ->with('allUser', $allUser);

    }


    public function storeUser($user, Request $request)
    {


        $seeker_id = session('seeker_id');

        $emp_id = trim(strip_tags($request->input('empid')));


        $level = trim(strip_tags($request->input('level')));
        $user = trim(strip_tags($user));

        $objSeeker = DB::table('seekers')
            ->select('user_name_company')
            ->where('seeker_id', $emp_id)
            ->first();
        $check = false;

        $oldCompany = "";
        if ($objSeeker->user_name_company == "" || $objSeeker->user_name_company == null) {
            $check = false;

        } else {
            $objSession = explode("+", $objSeeker->user_name_company);
            foreach ($objSession as $item) {
                if ($user == $item) {
                    $check = true;
                }
            }
        }
        $objCompany = DB::table('companys')
            ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
            ->select('companys.comp_id')
            ->where('comp_user_name', $user)
            ->where('managers.seeker_id', $seeker_id)
            ->where('managers.level', 'a')
            ->first();
        if ($objCompany != null) {
            if (!$check) {


                DB::table('managers')->insert([
                    'seeker_id' => $emp_id,
                    'comp_id' => $objCompany->comp_id,
                    'level' => $level,
                    'block_admin' => 0
                ]);

                if ($objSeeker->user_name_company == "" || $objSeeker->user_name_company == null) {
                    DB::table('seekers')
                        ->where('seeker_id', $emp_id)
                        ->update([
                            'have_company' => 1,
                            'user_name_company' => $user
                        ]);
                } else {
                    DB::table('seekers')
                        ->where('seeker_id', $emp_id)
                        ->update([
                            'have_company' => 1,
                            'user_name_company' => $objSeeker->user_name_company . '+' . $user
                        ]);
                }
            } else {

                DB::table('managers')
                    ->where('seeker_id', $emp_id)
                    ->where('comp_id', $objCompany->comp_id)
                    ->update([

                        'level' => $level,
                        'block_admin' => 0
                    ]);
            }
        }
        return redirect('/company-profile/users/' . $user);


    }

    public function editUser($user, $id)
    {

        $allUser = DB::table('seekers')
            ->join('managers', 'managers.seeker_id', '=', 'seekers.seeker_id')
            ->where('managers.manager_id', $id)
            ->first();

        return view('company.modal.edit.euser')
            ->with('user', $user)
            ->with('allUser', $allUser);
    }

}


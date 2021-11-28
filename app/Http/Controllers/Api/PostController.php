<?php

namespace App\Http\Controllers\Api;

use App\Jobs\SendNoteAndroidJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use App\SeekerPrice;
use Intervention\Image\Facades\Image;
use Redis;

class PostController extends Controller
{
    //

    public function index()
    {
        $post = DB::table('seekers')->where('seeker_id', Auth::user()->seeker_id)->get();


        // dd($post);

        return response()->json(['data' => $post], 200, [], JSON_NUMERIC_CHECK);
    }


    public function we()
    {

        $redis = Redis::connection();



        $dataStaticRedis = $redis->get('welcome:data');

        $dataStatic = json_decode($dataStaticRedis, TRUE);

        $o =   array(
            "about" => $dataStatic['company'],
            "services" => $dataStatic['services'],
            "address" => $dataStatic['seekers'],
            "phone" => $dataStatic['desc'],



        );



        // dd($post);

        return response()->json($o, 200, [], JSON_NUMERIC_CHECK);
    }

    public function editInfo()
    {

        $seekers_id = Auth::user()->seeker_id;
        $city = Helpers::getDataSeeker('job_city', null, false);
        $edt = Helpers::getDataSeeker('job_edt', null, false);
        $job_seeker = Helpers::getDataSeeker('seekers', $seekers_id, true);
        $domain_type = Helpers::getDataSeeker('job_domain', null, false);

        $actual_link = "https://www.libyacv.com";

        if ($job_seeker->image == "") {
            if ($job_seeker->gender == "f")
                $stringImage = $actual_link . "/images/simple/140px_female.png";
            else
                $stringImage = $actual_link . "/images/simple/140px_male.png";
        } else {
            $stringImage = $actual_link . "/images/seeker/140px_" . $job_seeker->code_image . "_" . $job_seeker->image;
        }



        $job_seeker->email = $job_seeker->email1;

        $job_seeker->image = $stringImage;

        return response()->json(
            array('data' => array([
                'city' => $city,
                'edt' => $edt,
                'domain' => $domain_type,

                'info' => $job_seeker,
            ])),
            200
        );

        // return response()->json(['data'=>$job_seeker],200,[],JSON_NUMERIC_CHECK);

    }

    public function updateImageSeeker(Request $request)
    {

        $seeker_id = Auth::user()->seeker_id;
        $job_seeker = Helpers::getDataSeeker('seekers', $seeker_id, false);

        $code_image =  $job_seeker->code_image;


        $code = str_random(15);

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
            && ($request->file('file')->getSize() < 1500000)
        ) {

            $imageName = $seeker_id . '.jpg';


            $filename300 = base_path() . '/public/images/seeker/300px_' . $code_image . '_' . $imageName;
            $filename140 = base_path() . '/public/images/seeker/140px_' . $code_image . '_' . $imageName;
            $filename40 = base_path() . '/public/images/seeker/40px_' . $code_image . '_' . $imageName;

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
            $filename = base_path() . '/public/images/seeker_new/' . '_' . $code . '_' . $imageName;

            $newNameImage =  '_' . $code . '_' . $imageName;

            $request->file('file')->move(
                base_path() . '/public/images/seeker_new/',
                $newNameImage
            );


            if (file_exists($filename)) {
                $img = Image::make($filename);

                $img->resize(300, 300);


                // insert a watermark
                //        $img->insert('public/watermark.png');

                // save image in desired format
                $img->save(base_path() . '/public/images/seeker/300px' . $newNameImage);
                $img->resize(140, 140);

                $img->save(base_path() . '/public/images/seeker/140px' . $newNameImage);
                $img->resize(40, 40);

                $img->save(base_path() . '/public/images/seeker/40px' . $newNameImage);
                /*   $thumb = new easyphpthumbnail();


                   $thumb->Thumbsize = 300;

                   $thumb->Thumbsaveas = 'jpg';
                   $thumb->Thumblocation = 'images/seeker/300px';
                   $thumb->Createthumb($filename, 'file');

                   $thumb->Thumbsize = 140;
                   $thumb->Thumbsaveas = 'jpg';
                   $thumb->Thumblocation = 'images/seeker/';
                   $thumb->Thumbprefix = '140px';
                   $thumb->Createthumb($filename, 'file');

                   $thumb->Thumbsize = 40;
                   $thumb->Thumbsaveas = 'jpg';
                   $thumb->Thumblocation = 'images/seeker/';
                   $thumb->Thumbprefix = '40px';
                   $thumb->Createthumb($filename, 'file');*/
                //  $thumb =  base_path() . '/public/images/seeker/'.$imageName;

                DB::table('seekers')
                    ->where('seeker_id', $seeker_id)
                    ->update([
                        'image' => $imageName,
                        'code_image' => $code,

                    ]);

                Helpers::getDataSeeker('seekers', $seeker_id, true);

                return response()->json(['message' => Helpers::getMessage("saved")], 200);
            }
        } else {


            return response()->json(['message' => "الرجاء استخدام صورة بحجم اقل من 200 Kb"], 200);
        }

        Helpers::getDataSeeker('seekers', $seeker_id, true);

        return response()->json(['message' => Helpers::getMessage("saved")], 200);
    }

    public function getDomainFireBaseSeeker()
    {

        // if( Auth::user() != null )
        $od = Auth::user()->seeker_id;



        $dataTable   = DB::select('select job_domain.domain_id ,domain_name,domain_name_en,  IF(soso.seeker_id > 0 ,TRUE,  FALSE )  as selected
          from job_domain
          left join (select * from seeker_note_firebase where seeker_id=' . $od . ') as soso on soso.domain_id = job_domain.domain_id order by job_domain.domain_id');
        $actual_link = "https://www.libyacv.com";

        $arr = array();
        $i = 0;
        foreach ($dataTable as $item) {
            $arr[$i++] =  array(
                'domain_id' => $item->domain_id,
                'domain_name' => $item->domain_name,
                'image' => $actual_link . "/images/simple/" . $item->domain_name_en . ".jpg",
                'selected' => ($item->selected == 1) ? true : false,
            );
        }
        return response()->json(
            $arr,
            200
        );
    }

    public function postDomainFireBaseSeeker(Request $request)
    {



        $od = Auth::user()->seeker_id;

        $arrNote =   $request->input('note');

        DB::table('seeker_note_firebase')
            ->where('seeker_id', $od)
            ->delete();

        if (!empty($arrNote)) {

            foreach ($arrNote as $value) {
                DB::table('seeker_note_firebase')
                    ->insert([
                        'seeker_id' => $od,
                        'domain_id' => $value,
                    ]);
            }
        }

        return response()->json(
            ['message' => Helpers::getMessage("saved")],
            200
        );
    }

    public function updateInfo(Request $request)
    {

        $seekers_id = Auth::user()->seeker_id;
        $fname = $request->input('fname');

        $about = $request->input('about');
        $address = $request->input('address');
        $birth_day     =     $request->input('birth_day');

        $goal = $request->input('goal');
        $email = $request->input('email1');


        $city_name = $request->input('city');
        $domain_name = $request->input('domain');
        $edt_name = $request->input('edt');
        $phone = $request->input('phone');

        $gender = $request->input('sex');
        if ($gender == "ذكر")
            $gender = "m";
        else
            $gender = "f";



        $cityTable = Helpers::getDataSeeker('job_city', null, false);
        $city_id = "";
        foreach ($cityTable as $obj) {
            if ($obj->city_name == $city_name) {
                $city_id = $obj->city_id;
                break;
            }
        }


        $EdtTable = Helpers::getDataSeeker('job_edt', null, false);
        $edt_id = "";
        foreach ($EdtTable as $obj) {
            if ($obj->edt_name == $edt_name) {
                $edt_id = $obj->edt_id;
            }
        }

        $domainTable = Helpers::getDataSeeker('job_domain', null, false);
        $domain_id = "";
        foreach ($domainTable as $obj) {
            if ($obj->domain_name == $domain_name) {
                $domain_id = $obj->domain_id;
            }
        }



        $phoneDate = DB::table('seekers')->select('phoned_date', 'phone')->where('seeker_id', $seekers_id)->first();
        $isDate = $isSuccsed = $isPhone = false;

        if ($phoneDate->phoned_date != null)
            $isDate = true;


        $plusPhone = "0" + $phone;
        if (ctype_digit($phone) && (
            ($phone[0] == "0" && strlen($phone) == 10) || ($phone[0] != "0" && strlen($phone) == 9)) && ($phoneDate->phone != $phone || $plusPhone != $phoneDate->phone))
            $isPhone = true;

        $now = \Carbon\Carbon::now();
        $plusDate = $now->subMonths(2);
        $date =  Carbon::parse($phoneDate->phoned_date);
        if ($isPhone) {

            $isSuccsed = true;
        }
        $count = DB::table('seekers')->select('phone')->where('seeker_id', '!=', $seekers_id)->where('phone', $phone)->count();

        if ($domain_id == "")
            $domain_id = 1;

        if ($address == "")
            $address = " ";
        if ($isSuccsed) {
            DB::table('seekers')
                ->where('seeker_id', $seekers_id)->update([
                    'fname' => $fname,
                    // 'lname' => $lname,
                    'about' => $about,
                    'address' => $address,
                    'phone' => $phone,
                    'city_id' => $city_id,
                    'domain_id' => $domain_id,
                    'edt_id' => $edt_id,
                    'birth_day' => $birth_day,
                    'gender' => $gender,
                    'goal_text' => $goal,
                    'email1' => $email,
                    'phoned_date' => \Carbon\Carbon::now()
                ]);
        } else {
            DB::table('seekers')
                ->where('seeker_id', $seekers_id)->update([
                    'fname' => $fname,
                    // 'lname' => $lname,
                    'about' => $about,
                    'address' => $address,
                    // 'phone' => $phone,
                    'domain_id' => $domain_id,
                    'email1' => $email,
                    'city_id' => $city_id,
                    'edt_id' => $edt_id,
                    'birth_day' => $birth_day,
                    'gender' => $gender,
                    'goal_text' => $goal,
                ]);
        }
        Helpers::getDataSeeker('seekers', $seekers_id, true);

        return response()->json(
            ['message' => Helpers::getMessage("saved")],
            200
        );
    }



    public function editRefresh()
    {
        $seekers_id = Auth::user()->seeker_id;

        $checkBool = false;
        $job_seeker =   Helpers::getDataSeeker('seekers', $seekers_id, true);
        $checkDate =  date('Y-m-d', strtotime("-10 days"));
        $updateDate =  date('Y-m-d', strtotime($job_seeker->updated_at));

        if ($checkDate >= $updateDate)
            $checkBool = true;

        $data = array(
            'update' => $job_seeker->updated_at,
            'check_date' => $checkBool,
        );
        return response()->json(
            ["refreshed" => $data],
            200
        );
    }

    public function storeRefresh()
    {
        $seekers_id = Auth::user()->seeker_id;
        $minCV = DB::table('seekers')->min('cv_down');
        DB::table('seekers')->where('seeker_id', $seekers_id)->update([
            'cv_down' => $minCV - 1,
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        $job_seeker = Helpers::getDataSeeker('seekers', $seekers_id, true);
        $checkDate =  date('Y-m-d', strtotime("-10 days"));
        $updateDate =  date('Y-m-d', strtotime($job_seeker->updated_at));
        $checkBool = false;

        if ($checkDate >= $updateDate)
            $checkBool = true;

        $data = array(
            'update' => $job_seeker->updated_at,
            'check_date' => $checkBool,
        );
        return response()->json(
            ["refreshed" => $data],
            200
        );
    }


    public function getSetting()
    {
        $seekers_id = Auth::user()->seeker_id;

        $job_seeker = Helpers::getDataSeeker('seekers', $seekers_id, false);

        $hide = $job_seeker->hide_cv;

        return response()->json(
            ["info" => $job_seeker],
            200
        );
    }

    public function storeSetting(Request $request)
    {
        $seekers_id = Auth::user()->seeker_id;

        $gender = $request->input('hide');
        $phone = $request->input('phone');
        $image = $request->input('image');


        switch ($phone) {
            case "إخفاء عن الكل":
                $phone = 0;
                break;
            case "عرض للكل":
                $phone = 1;
                break;
            case "عرض للموظف المتقدم علي إعلانه":
                $phone = 2;
                break;
        }

        switch ($image) {
            case "إخفاء عن الكل":
                $image = 0;

                break;
            case "عرض للكل":
                $image = 1;
                break;
            case "عرض للموظف المتقدم علي إعلانه":
                $image = 2;
                break;
        }
        if ($gender == "إظهار")
            $gender = "0";
        else
            $gender = "1";



        DB::table('seekers')->where('seeker_id', $seekers_id)
            ->update([
                'hide_cv' => $gender,
                'phone_view' => $phone,
                'image_view' => $image
            ]);


        Helpers::getDataSeeker('seekers', $seekers_id, true);

        return response()->json(
            ['message' => Helpers::getMessage("saved")],
            200
        );
    }

    public function changePassword(Request $request)
    {
        $seekers_id = Auth::user()->seeker_id;
        $status = false;
        if (strlen($request->input('password')) >= 6) {
            $pass_old = $request->input('password');
            $pass_new = Hash::make($request->input('newpassword'));

            $check = DB::table('seekers')
                ->select('password')
                ->where('seeker_id', $seekers_id)
                ->first();

            $status = Hash::check($pass_old,  $check->password);

            if ($status) {

                DB::table('seekers')
                    ->where('seeker_id', $seekers_id)
                    ->update([
                        'password' => $pass_new,
                    ]);
                return response()->json(
                    ['message' => Helpers::getMessage("saved")],
                    200
                );
            }
        }

        return response()->json(
            ['message' => Helpers::getMessage("error")],
            200
        );
    }

    public function  getNote()
    {
        $seekers_id = Auth::user()->seeker_id;

        $notes = DB::table('notifications')->select('data', 'created_at')->where('seeker_id', $seekers_id)->orderby('id', 'desc')->take(20)->get();
        return response()->json(
            $notes,
            200
        );
    }

    public function getMessage(Request $request)
    {
        $token = $request->input('tok');
        $number = $request->input('number');
        $price = $request->input('price');
        $date = $request->input('date');
        $hour = $request->input('hour');
        $minute = $request->input('minute');
        $body = $request->input('body');
        $number = "0" . $number;
        $obj_seeker = DB::table("seekers")
            ->select("seeker_id", "price", "user_name")
            ->where("phone", $number)
            ->first();

        if ($obj_seeker == null) {

            $objResponse =  array("data" => [
                "seeker_id" => 0,
                "user_name" => "",
                "price" => "",
                "isadd" => 0,
                "notfound" => 1,
                "message" => "error",
            ]);
            return response()->json(
                $objResponse,
                200
            );
        }


        $seeker_price = new SeekerPrice;

        $seeker_price->seeker_id = $obj_seeker->seeker_id;
        $seeker_price->phone_number = $number;
        $seeker_price->price =  $price;
        $seeker_price->date = $date;
        $seeker_price->hour = $hour;
        $seeker_price->minute = $minute;
        $seeker_price->body = $body;
        $seeker_price->create_date =  \Carbon\Carbon::now();

        $seeker_price->save();


        $content = "شكراً لك على دعمك للمشروع، تم إضافة رصيد لحسابك بقيمة: " . $price . " درهم.";

        Helpers::AddNote($obj_seeker->seeker_id, $content, 4, 1);

        $job  = (new SendNoteAndroidJob($seeker_price))->delay(10);
        dispatch($job)->delay(now()->addSecond(10)); //onQueue('emails');
        $job->delete();

        $totalPrice = $obj_seeker->price + $price;


        DB::table("seekers")
            ->where('seeker_id', $obj_seeker->seeker_id)
            ->update([
                "price" => $totalPrice,
            ]);


        $objResponse =  array("data" => [
            "seeker_id" => $obj_seeker->seeker_id,
            "user_name" => $obj_seeker->user_name,
            "price" => $price,
            "isadd" => 1,
            "notfound" => 0,
            "message" => "تمت الاضافة بنجاح",
        ]);

        return response()->json(
            $objResponse,
            200
        );
    }

    public function addToken(Request $request)
    {

        $seekers_id = Auth::user()->seeker_id;

        $token = $request->input('fcmToken');


        $exist =  DB::table("seeker_note_firebase")->where('seeker_id', $seekers_id)->first();
        if ($exist == null) {



            $arrDomain = array();
            $domain_type = Helpers::getDataSeeker('job_domain', null, false);
            $i = 0;
            foreach ($domain_type as $item) {
                $arrDomain[$i] = $item->domain_id;
                $i++;
            }
            $index = mt_rand(0, count($arrDomain) - 1);



            DB::table('seeker_note_firebase')
                ->insert([
                    "domain_id" => $arrDomain[$index],
                    "seeker_id" => $seekers_id
                ]);
            array_splice($arrDomain, $index, 1);
            $index = mt_rand(0, count($arrDomain) - 1);

            DB::table('seeker_note_firebase')
                ->insert([
                    "domain_id" => $arrDomain[$index],
                    "seeker_id" => $seekers_id
                ]);
            array_splice($arrDomain, $index, 1);

            $index = mt_rand(0, count($arrDomain) - 1);

            /*     DB::table('seeker_note_firebase')
                   ->insert([
                       "domain_id"=> $arrDomain[$index],
                       "seeker_id"=>$seekers_id
                   ]);
               array_splice($arrDomain, $index, 1);
               $index = mt_rand(0, count($arrDomain) - 1);

               DB::table('seeker_note_firebase')
                   ->insert([
                       "domain_id"=> $arrDomain[$index],
                       "seeker_id"=>$seekers_id
                   ]);*/
        }
        /*     DB::table('seekers')
                 ->where('fcm_token',$token)
                 ->update([
                     'fcm_token' =>null
                 ]);*/

        DB::table('seekers')
            ->where('seeker_id', $seekers_id)
            ->update([
                'fcm_token' => $token
            ]);
        //   $job_seeker = Helpers::getDataSeeker('seekers',$seekers_id,false);


        //  $hide = $job_seeker->hide_cv;

        return response()->json(
            ["message" => "تم تسجيل الدخول بنجاح."],
            200
        );
    }

    public function changeImage(Request $request)
    {
        $seekers_id = Auth::user()->seeker_id;

        $statusImage = $request->input('image');
        if ($statusImage == null)
            $statusImage = 0;
        DB::table('seekers')
            ->where('seeker_id', $seekers_id)
            ->update([
                'image_view' => $statusImage,
            ]);

        Helpers::getDataSeeker('seekers', $seekers_id, true);

        return response()->json(
            ['message' => Helpers::getMessage("saved")],
            200
        );
    }

    public function changePhone(Request $request)
    {
        $seekers_id = Auth::user()->seeker_id;

        $statusPhone = $request->input('phone');

        if ($statusPhone == null)
            $statusPhone = 0;
        DB::table('seekers')
            ->where('seeker_id', $seekers_id)
            ->update([
                'phone_view' => $statusPhone,
            ]);
        Helpers::getDataSeeker('seekers', $seekers_id, true);

        return response()->json(
            ['message' => Helpers::getMessage("saved")],
            200
        );
    }
}

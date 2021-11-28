<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    public function allPriceProduct()
    {

        $CategoryId = null;
        if (!empty($_GET['id'])) {
            $CategoryId =  $_GET['id'];
        } else {
            $CategoryId = null;
        }

        $list = DB::table('product')
            ->select('product.name', 'id as product_id', 'price', 'category_id')->where('is_active', '=', true);
        //   ->join('price','price.product_id','=','product.id');
        // ->join('category','category.id','=','product.category_id');


        if ($CategoryId != null) {
            if ($CategoryId != 0)
                $list = $list->where('category_id', '=', $CategoryId);
        }
        $list =  $list->get();

        return response()->json($list, 200);
    }

    public function refresh()
    {
        $client = new \GuzzleHttp\Client();

        $api = "https://sada.ly/wp-admin/admin-ajax.php?action=get_wdtable&table_id=2";
        // $res = $client->request('POST', $api, ['draw' => 1]);
        $res = $client->post($api, [
            'form_params' => [
                'draw' => 1
            ],
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],

        ]);

        // dump($res->getHeaders());

        $data = json_decode(
            $res->getBody(),
            true
        );
        foreach ($data['data'] as $item) {
            dump($item[0]);
        }

        dd($data['data']);
    }
    public function getVersion()
    {

        $lastUpdate = DB::table('product')->select('id', 'created_at')->orderBy('created_at', 'desc')->first();
        $ff = $this->ArabicDate($lastUpdate->created_at);

        return response()->json($ff, 200);
    }

    function ArabicDate($your_date)
    {
        $months = array("Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر");
        //$your_date = date('y-m-d'); // The Current Date
        $storemDate = strtotime($your_date);
        $en_month = date("M", $storemDate);
        foreach ($months as $en => $ar) {
            if ($en == $en_month) {
                $ar_month = $ar;
            }
        }

        $find = array("Sat", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri");
        $replace = array("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
        $ar_day_format = date('D', $storemDate); // The Current Day
        $ar_day = str_replace($find, $replace, $ar_day_format);

        header('Content-Type: text/html; charset=utf-8');
        //$standard = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        //$eastern_arabic_symbols = array("٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"); //'اخر تحديث'.' '.
        $current_date = $ar_day . ' ' . date('d', $storemDate) . ' ' . $ar_month . ' ' . date('Y', $storemDate) . ' - ' . date('H:i', $storemDate); //
        //$arabic_date = str_replace($standard , $eastern_arabic_symbols , $current_date);
        $arabic_date = $current_date;

        return $arabic_date;
    }


    public function category()
    {
        $list = DB::table('category')->get();
        return response()->json($list, 200);
    }

    public function indexOld()
    {
        $list = DB::table('product')->get();
        return response()->json($list, 200);
    }



    /*public function allPriceProduct(){
        $result = DB::table('product')
            ->join('price','price.product_id','=','product.id')
            ->get();
        return response()->json($result, 200);*/
}

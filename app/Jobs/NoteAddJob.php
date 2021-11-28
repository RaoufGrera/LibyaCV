<?php

namespace App\Jobs;

use App\Desc;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use DB;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class NoteAddJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 30;
    public $tries = 3;


    protected $desc;
    public function __construct(Desc $desc)
    {
        //  Log::info("NoteDesc Android is Work 0");

        $this->desc = $desc;
    }


    public function handle()
    {

        /*  $req = $this->desc;
        $desc_id = $req->desc_id;

        $theDesc = DB::table('job_description')
            ->select('desc_id')
             ->where('desc_id', '=', $desc_id)
            ->first();

        if($theDesc == null)
            return false;

        $timestamp = Now('Africa/Tripoli');

        $first ="";
        $name =  $req->job_name;

        $companyName = DB::table('companys')
            ->select('comp_name','companys.comp_id')
            ->join('managers', 'managers.comp_id', '=', 'companys.comp_id')
            ->where('managers.manager_id', '=', $req->manager_id)
             ->first();

        $first =" إشعار من شركة تتابعها ";

         $data_send = $name.$first;
        $seekers= DB::table('followers_company')
            ->join('seekers','seekers.seeker_id','=','followers_company.seeker_id')
          ->where('comp_id',$companyName->comp_id)
            ->select('seekers.seeker_id','fcm_token')->get();
        $optionBuilder = new OptionsBuilder();
         $dataBuilder = new PayloadDataBuilder();
        $title="وظيفة شاغرة";

        $notificationBuilder = new PayloadNotificationBuilder("وظيفة شاغرة");

        $dataBuilder->addData(['title' => $title,'body' => $data_send,'send' => 'job',
            'id'=>$desc_id]);


        $option = $optionBuilder->build();
        $data = $dataBuilder->build();
       foreach ($seekers as $seeker){
           $isAndroid = 0;
           if($seeker->fcm_token != null)
               $isAndroid =1;

            DB::table('notifications')->insert([
                'seeker_id' =>$seeker->seeker_id,
                'data' =>$data_send,
                'created_at'=>$timestamp,
                'note_type_id'=>5,
                'isread' => $isAndroid
            ]);
            if($isAndroid == 1){
                $notificationBuilder->setBody($data_send)
                    ->setSound('default') ;
                $notification = $notificationBuilder->build();
           $downstreamResponse = FCM::sendTo($seeker->fcm_token, $option, $notification, $data);
           $downstreamResponse->numberSuccess();
       }
        }
*/ }
}

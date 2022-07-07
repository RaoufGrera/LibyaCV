<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Guest;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Notification;
use App\Notifications\SendWebNoti;


class SendWeb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:web';
    use Queueable;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send jobs to users and gusets web apps';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       
          //  $user = \App\Guest::all();
            $user = \App\Guest::all();

          
            $companyImage ='https://www.libyacv.com/images/simple/libyacv_logo.png';
           
        
             $action = "https://www.libyacv.com/job/search";
               
               
                $title ="وظائف شاغرة في ليبيا";
                $body ="أكثر من 10 وظائف شاغرة تم نشرها في الموقع.. للمزيد من التفاصيل يرجي زيارة الموقع";
                $icon = $companyImage;
                Notification::send($user,new SendWebNoti($title, $body,$icon, $action));
            
            
            DB::table('job_description')->update(['is_web' =>  1]);

/*

       //     $jobs = DB::table('job_description')
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
            ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')            
            ->where('is_web', '=', 0)
            ->where('managers.manager_id','!=',185)
           // ->where('job_description.desc_id','>',3981)
            ->select( 'image',
            'code_image', 'comp_name', 'job_name', 'job_description.desc_id')->get();

            $i=0;
            foreach($jobs as $job){
                $i++;
                if($i== 2)
                break;
                
                if($job->image !=""){$companyImage = 'https://www.libyacv.com/images/company/300px_'.$job->code_image.'_'.$job->image; }else{  $companyImage ='https://www.libyacv.com/images/simple/company.png';}
               
                    $separator="-";
                    $string = trim($job->job_name);
                    $string = mb_strtolower($string, 'UTF-8');
                    $string = preg_replace("/[^a-z0-9_\s-ءاآؤئليةبپتثجچحخدذرزسشصضطظعغفقكکگلمنوهی]/u", '', $string);
                    $string = preg_replace("/[\s-_]+/", ' ', $string);
                    $string = preg_replace("/[\s_]/", $separator, $string);
        
        
                    $action = "https://www.libyacv.com/job/".$job->desc_id."/".$string;
               
               
                $title =$job->comp_name;
                $body =$job->job_name;
                $icon = $companyImage;
                Notification::send($user,new SendWebNoti($title, $body,$icon, $action));
            //}
            */
           // $user->notify(new \App\Notifications\PushDemo());
          
           // return redirect()->back();
         
    }
}

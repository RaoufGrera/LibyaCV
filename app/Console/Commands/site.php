<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Spatie\Sitemap\SitemapGenerator;
use DB;
use Illuminate\Console\Command;

class site extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
       /* SitemapGenerator::create("https://www.libyacv.com")
            ->writeToFile(public_path('sitemap.xml'));*/

        $sitemap = App::make('sitemap');

        // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
        // by default cache is disabled
        $sitemap->setCache('laravel.sitemap', 60);

        $images=null;
        // check if there is cached sitemap and build new only if is not
        if (!$sitemap->isCached()) {
            // add item to the sitemap (url, date, priority, freq)
            $sitemap->add('https://www.libyacv.com/', '2019-10-1T20:10:00+02:00', '1.0', 'daily');
            $sitemap->add('https://www.libyacv.com/job/search', '2019-10-1T20:10:00+02:00', '1.0', 'daily');
            $sitemap->add('https://www.libyacv.com/cv/search', '2019-10-1T20:10:00+02:00', '1.0', 'daily');
            $sitemap->add('https://www.libyacv.com/company/search', '2019-10-1T20:10:00+02:00', '1.0', 'monthly');
            $sitemap->add('https://www.libyacv.com/free-cv-template', '2019-10-1T20:10:00+02:00', '1.0', 'monthly');
            $sitemap->add('https://www.libyacv.com/free-cv-template/arabic-resume', '2019-10-1T20:10:00+02:00', '1.0', 'monthly');
            $sitemap->add('https://www.libyacv.com/free-cv-template/english-resume', '2019-10-1T20:10:00+02:00', '1.0', 'monthly');

            // get all posts from db, with image relations
            $_imgSrc = 'images/';
            $urljob = 'https://www.libyacv.com/job/';
            $url = 'https://www.libyacv.com/';
            $posts = DB::table('job_description')
                ->select('job_description.desc_id','comp_name','job_name','image','code_image','job_description.created_at')
                ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
                ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
                ->get();
            // add every post to the sitemap
            foreach ($posts as $post) {
                if($post->image != ''){
                    $image = "company/300px_".$post->code_image ."_".$post->image ;

                }else{
                    $image ="simple/300px_company.png";
                }


                $tr=  $url.$_imgSrc.$image;
                $images = array();

                    $images[] = array(
                        'url' => $tr,
                        'title' => $post->comp_name,
                        'caption' => $post->comp_name
                    );


                $separator="-";
                $string = $post->job_name ;
                $string = trim($string);
                $string = mb_strtolower($string, 'UTF-8');
                $string = preg_replace("/[^a-z0-9_\s\-ءاآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهی]/u", '', $string);
                $string = preg_replace("/[\s-_]+/", ' ', $string);
                $string = preg_replace("/[\s_]/", $separator, $string);

                $string=$urljob.$post->desc_id.'/'.$string;
                $sitemap->add($string, $post->created_at, 0.6, 'daily', $images);
            }
        }
        $sitemap->store('xml', 'mysitemap');

    }
}

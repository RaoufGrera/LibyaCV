<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Spatie\Sitemap\SitemapGenerator;
use DB;
use Illuminate\Console\Command;

class SiteCV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:cv';

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
            /*    $sitemap->add(URL::to('/'), '2012-08-25T20:10:00+02:00', '1.0', 'daily');
                $sitemap->add(URL::to('/job/search'), '2012-08-25T20:10:00+02:00', '1.0', 'daily');
                $sitemap->add(URL::to('/cv/search'), '2012-08-25T20:10:00+02:00', '1.0', 'daily');
                $sitemap->add(URL::to('/company/search'), '2012-08-25T20:10:00+02:00', '1.0', 'monthly');
                $sitemap->add(URL::to('terms'), '2012-08-26T12:30:00+02:00', '0.9', 'monthly');
    */
            // get all posts from db, with image relations
            $_imgSrc = 'images/';
            $actual_link = 'https://www.libyacv.com/user/';
            $url = 'https://www.libyacv.com';
            $posts = DB::table('seekers')
                ->select('user_name','fname','created_at','gender','image','code_image')

                ->get();
            // add every post to the sitemap
            foreach ($posts as $post) {

                if($post->image == "") {
                    if($post->gender =="f")
                        $stringImage= $url."/images/simple/300px_female.png";
                    else
                        $stringImage= $url."/images/simple/300px_male.png";


                }else{
                    $stringImage= $url."/images/seeker/300px_". $post->code_image ."_". $post->image;
                }



                $tr=  $stringImage;
                $images = array();

                $images[] = array(
                    'url' => $tr,
                    'title' => $post->fname,
                    'caption' => $post->fname
                );


                $separator="-";
                $string = $post->user_name ;
                /*  $string = trim($string);
                  $string = mb_strtolower($string, 'UTF-8');
                  $string = preg_replace("/[^a-z0-9_\s-ءاآؤئليةبپتثجچحخدذرزسشصضطظعغفقكکگلمنوهی]/u", '', $string);
                  $string = preg_replace("/[\s-_]+/", ' ', $string);
                  $string = preg_replace("/[\s_]/", $separator, $string);
  */
                $string=$actual_link.$string;
                $sitemap->add($string, $post->created_at, 0.2, 'monthly', $images);
            }
        }
        $sitemap->store('xml', 'mysitemap_cv');

    }
}

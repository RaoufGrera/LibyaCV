<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Spatie\Sitemap\SitemapGenerator;
use DB;
use Illuminate\Console\Command;

class SiteCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:company';

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
            $urlcompany = 'https://www.libyacv.com/c/';
            $url = 'https://www.libyacv.com/';
            $posts = DB::table('companys')
                ->select('comp_user_name','comp_name','image','code_image','created_at')

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
                $string = $post->comp_user_name ;
              /*  $string = trim($string);
                $string = mb_strtolower($string, 'UTF-8');
                $string = preg_replace("/[^a-z0-9_\s-ءاآؤئليةبپتثجچحخدذرزسشصضطظعغفقكکگلمنوهی]/u", '', $string);
                $string = preg_replace("/[\s-_]+/", ' ', $string);
                $string = preg_replace("/[\s_]/", $separator, $string);
*/
                $string=$urlcompany.$string;
                $sitemap->add($string, $post->created_at, 0.9, 'daily', $images);
            }
        }
        $sitemap->store('xml', 'mysitemap_company');

    }
}

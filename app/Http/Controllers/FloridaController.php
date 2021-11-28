<?php

namespace App\Http\Controllers;
use IvoPetkov\HTML5DOMDocument;

use Illuminate\Http\Request;

class FloridaController extends Controller
{
    public function index()
    {


        $rss_url = 'https://www.indeed.com/jobs?q=&l=Florida';

        $client = new \GuzzleHttp\Client(['headers' => ['Accept' => 'application/json']]);

        $url = $rss_url;
        // dump($url);
        $res = $client->request('GET', $url, [
            'headers' => [
                'content-type' => 'application/json',
                'Accept' => 'application/json',

            ]
        ]);
          $GuzzleArr = $res->getBody();
        $dom = new  HTML5DOMDocument();
        $dom->loadHTML($GuzzleArr);
         dd($dom);




    /*    preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $item['content'], $matches);
        //  print_r($matches[0]);
        $email = "";
        if (array_key_exists(0, $matches[0]))
            $email = $matches[0][0];
        //   echo $email;
        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#',  $item['content'], $matchWeb);

        /*  echo "<pre>";
        print_r($matchWeb[0]);
        echo "</pre>";
*/

      /*  $website = "";
        if (array_key_exists(0, $matchWeb[0]))
            $website = $matchWeb[0][count($matchWeb[0]) - 1];
        //  echo $website;



        // returns all results in array $matches
        preg_match_all('/[0-9]{10}/', $item['content'], $matchesp);

        $phone = "";
        if (array_key_exists(0, $matchesp[0]))
            $phone = $matchesp[0][0];
        //  echo $phone;

        //  dump($phone);


        //  echo $dom->querySelector('.job-category')->innerHTML;
        $categoryTest = $dom->querySelector('.job-category');
        $htmlCategory="";
        if($categoryTest!= null) {
            $ee = $dom->querySelector('.job-category')->querySelector('a');
            $htmlCategory = $ee->innerHTML;
        }


        $eeCompany = $dom->querySelector('.job-company')->querySelector('a')->innerHTML;

        $trimCategory = trim($htmlCategory);

        // dump($trimCategory);
        $domain_id = $this->returnDomain($trimCategory);

        //  echo " domain id :  ";
        //  dump($domain_id);
        //  dump($item);
        if ($phone == "" && $email == "" && $website == "") {
            $contCompany = $dom->getElementById('contact_company_form');

            if($contCompany!= null) {
                $city2 = $dom->getElementById('contact_company_form')->innerHTML;
                preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $city2, $matches);
                //  print_r($matches[0]);

                if (array_key_exists(0, $matches[0]))
                    $email = $matches[0][0];
            }
        }*/

    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Lenovo1
 * Date: 3/12/2016
 * Time: 1:52 AM
 */

namespace app;

use DB;
use Carbon\Carbon;

class Search
{
    public function searchCv($query)
    {

        $result = DB::table('seekers');

        switch ($query['select']) {

            case 'exp':
                $result = $result ->select(DB::raw('SUM(TIMESTAMPDIFF(YEAR,job_exp.start_date,job_exp.end_date)) as sum_exp'));
                break;
            case 'all' :
                $result = $result
                    ->select('code_image','exp_sum','image_view','match','about','image','gender','seekers.updated_at',
                        'last_seen','user_name' ,'hide_cv', 'fname', 'lname','univ_id',
                        'seekers.edt_id','job_edt.edt_name','birth_day as age','see_it','goal_text','job_domain.domain_name','job_city.city_name',
                        'seekers.domain_id','nat_id', 'seekers.city_id' ,'address','seekers.seeker_id'
                       );
                break;
            case 'city':
                $result = $result->select('job_city.city_name', DB::raw('count(*) as city_count'));
                break;
            case 'domain':
                $result = $result->select('job_domain.domain_name', DB::raw('count(*) as domain_count'));
                break;
            case 'education':
                $result = $result->select('job_edt.edt_name', DB::raw('count(*) as edt_count'));
                break;
        }


        $result = $result  ->join('job_city', 'job_city.city_id', '=', 'seekers.city_id')
        ->join('job_domain', 'job_domain.domain_id', '=', 'seekers.domain_id')
        ->join('job_edt', 'job_edt.edt_id', '=', 'seekers.edt_id');

            switch ($query['select']) {

                case 'all' :
                    /*  $result = $result
                          ->groupby('seekers.seeker_id');*/
                    break;


                case 'city' :
                    $result = $result
                        ->groupby('job_city.city_name')
                    ->orderby('city_count', 'DESC');
                    break;


                case 'domain' :
                    $result = $result
                        ->groupby('job_domain.domain_name')
                        ->orderby('domain_count', 'DESC');
                    break;

                case 'education' :
                    $result = $result
                        ->groupby('job_edt.edt_name')
                        ->orderby('edt_count', 'DESC');
                    break;
            }

        if ($query['id'] != NULL)
            $result = $result->where('spec_seeker.seeker_id', '=', $query['id']);


        if ($query['string'] != NULL){
            $result = $result->where('seekers.fname', 'like', '%'.$query['string'].'%');
            $result = $result->Orwhere('seekers.lname', 'like', '%'.$query['string'].'%');
        }
        //Check City for searching
        if ($query['cityName'] != NULL)
            $result = $result->where('job_city.city_name', '=', $query['cityName']);



         if ($query['domainName'] != NULL)
            $result = $result->where('job_domain.domain_name', '=', $query['domainName']);

         if ($query['edtName'] != NULL)
            $result = $result->where('job_edt.edt_name', '=', $query['edtName']);


        $result = $result->where('hide_cv', '=', 0);
        $result = $result->where('seekers.edt_id', '!=', 5);


        if($query['end'] !=NULL ){
        $result = $result->orderby('cv_down');
        $result = $result->take($query['end']);
        $result = $result->skip($query['start']);
        }


            $result = $result->get();

        return $result;
    }


    public function searchURL($urls)
    {

        $href = array(
            "string" => $urls['string'],
            "city" => $urls['cityName'],
            "domain" => $urls['domainName'],
            "education" => $urls['edtName'],
            "page" => $urls['page']
        );


        return $href;
    }



       public function SearchCompany($query)
    {
        $result = DB::table('companys');
        switch ($query['select']) {
            case 'all' :
                $result = $result->select('services','comp_id','about','endstar','isstar','image','code_image', 'domain_name','comp_user_name', 'see_it', 'url',
                    'compt_name','website','phone','email','facebook', 'city_name','about','address','comp_name');
                break;
        }
        if ($query['string'] != NULL)
            $result = $result->where('comp_name', 'like', '%'.$query['string'].'%');
        if ($query['cityName'] != NULL)
            $result = $result->where('city_name', '=', $query['cityName']);
        if ($query['domainName'] != NULL)
            $result = $result->where('domain_name', '=', $query['domainName']);
        if ($query['typeName'] != NULL)
            $result = $result->where('compt_name', '=', $query['typeName']);
        if($query['end'] !=NULL ){
            $result = $result->take($query['end']);
            $result = $result->skip($query['start']);
            $result = $result->orderBy('comp_id', 'desc');

        }
        $result = $result->get();
        return $result;
    }

    public function SearchCompanyStar($query)
    {
        $result = DB::table('companys');
        switch ($query['select']) {
            case 'all' :
                $result = $result->select('services','comp_id','about','endstar','isstar','image','code_image', 'domain_name','comp_user_name', 'see_it', 'url',
                    'compt_name', 'city_name','about','address','comp_name');
                break;
        }


       // $result = $result->where('endstar', '>=', NOW());

        if ($query['string'] != NULL)
            $result = $result->where('comp_name', 'like', '%'.$query['string'].'%');
        if ($query['cityName'] != NULL)
            $result = $result->where('city_name', '=', $query['cityName']);
        if ($query['domainName'] != NULL)
            $result = $result->where('domain_name', '=', $query['domainName']);
        if ($query['typeName'] != NULL)
            $result = $result->where('compt_name', '=', $query['typeName']);
        if($query['end'] !=NULL ){
            $result = $result->take($query['end']);
            $result = $result->skip($query['start']);

        }
        $result = $result->get();
        return $result;
    }


    public function searchCompanyURL($urls)
    {

        $href = array(
            "string" => $urls['string'],
            "city" => $urls['cityName'],
            "domain" => $urls['domainName'],
            "type" => $urls['typeName'],
            "page" => $urls['page']
        );

        return $href;
    }
    public function SearchServices($query)
    {
        $result = DB::table('services');


        switch ($query['select']) {
            case 'all' :
                $result = $result->select('services.seeker_id','services_id','gender','services.see_it','about','title','body','user_name','fname','city_name','image','code_image', 'domain_name',
                    'address' );
                break;
        }
        $result = $result  ->join('seekers','seekers.seeker_id','=','services.seeker_id')
        ->join('job_city','job_city.city_id','=','services.city_id')
        ->join('job_domain','job_domain.domain_id','=','services.domain_id');
        if ($query['string'] != NULL)
            $result = $result->where('title', 'like', '%'.$query['string'].'%');
        if ($query['cityName'] != NULL)
            $result = $result->where('city_name', '=', $query['cityName']);
        if ($query['domainName'] != NULL)
            $result = $result->where('domain_name', '=', $query['domainName']);

        if($query['end'] !=NULL ){
            $result = $result->take($query['end']);
            $result = $result->skip($query['start']);
            $result = $result->orderBy('services_id', 'desc');

        }
        $result = $result->get();
        return $result;
    }

    public function searchServicesURL($urls)
    {

        $href = array(
            "string" => $urls['string'],
            "city" => $urls['cityName'],
            "domain" => $urls['domainName'],
             "page" => $urls['page']
        );

        return $href;
    }
    public function searchJobStars($query){
        $result = DB::table('job_description');

        switch ($query['select']) {

            case 'all' :
                $result = $result
                    ->select('job_description.desc_id','job_description.isstar','image','comp_user_name','code_image','job_description.created_at',
                        'job_description.see_it','comp_user_name','job_desc','job_end','job_description.created_at','job_start',
                        'job_name','url','comp_name','comp_active',
                        'job_domain.domain_name', 'job_city.city_name' ,'address');
                break;
        }


        $result = $result
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
            ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
            ->join('job_city', 'job_city.city_id', '=', 'job_description.city_id')
            ->join('job_domain', 'job_domain.domain_id', '=', 'job_description.domain_id');

        $result = $result
            ->where('is_active',0)
            ->where('managers.block_admin',0)
            ->where('job_description.block_admin',0);
      /**  switch ($query['select']) {
            case 'all' :
                $result = $result
                    ->groupby('job_description.desc_id');
                break;
        }
*/
       // $result = $result->where('job_description.job_end', '>=', NOW());

     //   $result = $result->where('job_description.starenddate', '>=', NOW());

        //Check City for searching
        if ($query['cityName'] != NULL)
            $result = $result->where('job_city.city_name', '=', $query['cityName']);

        //Check domain for searching
        if ($query['domainName'] != NULL)
            $result = $result->where('job_domain.domain_name', '=', $query['domainName']);

        /* End Where in sql query */

       if($query['end'] !=NULL ){
            $result = $result->take($query['end']);
          //  $result = $result->skip($query['start']);
        }

        $result = $result->get();
        return $result;


    }
    public function SearchJob($query)
    {

        $result = DB::table('job_description');

        switch ($query['select']) {

            case 'all' :
                $result = $result
                 ->select('job_description.desc_id','job_description.isstar','job_description.starenddate','image','comp_user_name','code_image','job_description.created_at',
                     'job_description.see_it','is_refresh','job_desc','job_end','job_start',
                 'job_name','url','comp_user_name','comp_name','comp_active',
                    'job_domain.domain_name','desc_down', 'job_city.city_name' ,'address');
                break;

            case 'city':
                $result = $result->select('job_city.city_name', DB::raw('count(*) as city_count'));
                break;
            case 'domain':
                $result = $result->select('job_domain.domain_name', DB::raw('count(*) as domain_count'));
                break;
        }


        $result = $result
            ->join('managers', 'managers.manager_id', '=', 'job_description.manager_id')
            ->join('companys', 'companys.comp_id', '=', 'managers.comp_id')
            ->join('job_city', 'job_city.city_id', '=', 'job_description.city_id')
             ->join('job_domain', 'job_domain.domain_id', '=', 'job_description.domain_id');
          //  ->leftJoin('job_type', 'job_type.type_id', '=', 'job_description.type_id')
      //      ->leftJoin('job_status', 'job_status.status_id', '=', 'job_description.status_id');


        $result = $result
            ->where('is_active',1);
           // ->where('managers.block_admin',0)
           // ->where('job_description.block_admin',0);
        switch ($query['select']) {

            /*    case 'all' :
                    $result = $result
                        ->groupby('job_description.desc_id');
                    break;
   */
                case 'city' :
                    $result = $result
                        ->groupby('job_city.city_name')
                        ->orderby('city_count','DESC');
                    break;
            case 'domain' :
                $result = $result
                    ->groupby('job_domain.domain_name')
                    ->orderby('domain_count','DESC');

                break;
              /*  case 'status' :
                    $result = $result
                        ->where('job_description.status_id','!=',null)
                        ->groupby('status_name');
                    break;
    */


               /* case 'type' :
                    $result = $result
                        ->where('job_description.type_id','!=',null)
                        ->groupby('type_name');
                    break;

                case 'edt' :
                    $result = $result
                        ->where('job_description.edt_id','!=',null)
                        ->groupby('edt_name');
                    break;

                case 'spec' :
                    $result = $result
                        ->groupby('spec_name')
                        ->orderby('spec_count','DESC');;
                    break;


    */
            }

        //$result = $result->where('job_description.job_end', '>=', NOW());
        /* Start Where on sql query */
        if ($query['id'] != NULL)
            $result = $result->where('spec_desc.desc_id', '=', $query['id']);
        //Check string for searching
        if ($query['string'] != NULL)
            $result = $result->where('job_description.job_name', 'like', '%'.$query['string'].'%');

        //Check City for searching
        if ($query['cityName'] != NULL)
            $result = $result->where('job_city.city_name', '=', $query['cityName']);

        //Check domain for searching
        if ($query['domainName'] != NULL)
            $result = $result->where('job_domain.domain_name', '=', $query['domainName']);

        //Check Education = edtName for searching
       /* if ($query['typeName'] != NULL)
            $result = $result->where('job_type.type_name', '=', $query['typeName']);

        if ($query['statusName'] != NULL)
            $result = $result->where('job_status.status_name', '=', $query['statusName']);
/*
        if ($query['select'] != 'spec') {
            if ($query['specName'] != NULL)
                $result = $result->where('spec.spec_name', '=', $query['specName']);
        }
        if ($query['companyName'] != NULL)
            $result = $result->where('companys.comp_name', '=', $query['companyName']);


*/

        /* End Where in sql query */

        if($query['end'] !=NULL ){
            $result = $result->orderby('desc_down');

            $result = $result->take($query['end']);
            $result = $result->skip($query['start']);
        }

        $result = $result->get();
        return $result;
    }

    public function searchJobURL($urls)
    {

        $href = array(
            "string" => $urls['string'],
            "city" => $urls['cityName'],
            "domain" => $urls['domainName'],

         //   "type" => $urls['typeName'],
          //  "status" => $urls['statusName'],
            "page" => $urls['page']
        );

        return $href;
    }

    /*
     *
     *
     */
    public function searchApp($query)
    {

        $result = DB::table('job_seeker_req');

        switch ($query['select']) {

            case 'all' :
                $result = $result
                    ->select('code_image','seekers.about','seekers.image','gender','seekers.city_id','req_event',
                        'last_seen','seekers.user_name' ,'hide_cv', 'fname', 'lname','seekers.updated_at','seekers.match',
                        'seekers.edt_id','birth_day as age','seekers.see_it','exp_sum',
                        'seekers.domain_id','seekers.nat_id', 'seekers.city_id' ,'seekers.address','seekers.seeker_id','req_id'
                    );
                break;


        }


        $result = $result
            ->join('seekers', 'seekers.seeker_id', '=', 'job_seeker_req.seeker_id')
            ->join('job_description', 'job_description.desc_id', '=', 'job_seeker_req.desc_id');





        if ($query['desc_id'] != NULL)
            $result = $result->where('job_description.desc_id', '=',$query['desc_id']);

            $result = $result->where('job_seeker_req.req_event', '!=',2);


        if($query['end'] !=NULL ){
            $result = $result->take($query['end']);
            $result = $result->skip($query['start']);
        }

        $result = $result->get();
        return $result;
    }


    public function searchAppURL($urls)
    {

        $href = array(

            "page" => $urls['page']
        );

        return $href;
    }

}
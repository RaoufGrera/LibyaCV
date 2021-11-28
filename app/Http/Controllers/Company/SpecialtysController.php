<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Helpers;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SpecialtysController extends Controller
{
    private $pageName;

    public function __construct()
    {
        $this->pageName = "spec";

    }
    public function index()
    {

    }

    public function create($user)
    {
        $seeker_id = session('seeker_id');
        $company= Helpers::getDataSeeker('seekerCompany',$seeker_id,false);

        if(empty($company))
            return view('company.modal.error');

        return view('company.modal.add.aspec')
            ->with('user',$user);
    }

    public function store(Request $request,$user)
    {
        $id = session('seeker_id');

        $spec = trim(strip_tags($request->input('specSeeker')));
        $company= Helpers::getDataSeeker('seekerCompany',$id,false);
        if(empty($company)){
            return Redirect::to('/profile');
        }

        $returnedData = Helpers::getRedis('spec', $spec);


        if ($returnedData != "empty") {

            $spec_id = $returnedData;

                DB::table('spec_company')->insert([
                    'comp_id' => $company->comp_id,
                    'spec_id' => $spec_id,
                ]);

        } else {

            if (!empty($spec)) {
                $spec_id = DB::table('spec')->insertGetId(['spec_name' => $spec]);

                Helpers::setRedis('spec', $spec . "*" . $spec_id);
                    DB::table('spec_company')->insert([
                        'comp_id' => $company->comp_id,
                        'spec_id' => $spec_id,
                    ]);
            }
        }
        $message = "";
        $company_spec = Helpers::getDataSeeker('spec_company', $company->comp_id, true);

        $data = [
            "company_spec" => $company_spec,
            "user" => $user
        ];

        return Helpers::showModalCompany($this->pageName, $data, $message);
    }
    public function show($id)
    {

    }
    public function edit($id)
    {
        $seeker_id = Auth::guard('seekers')->user()->seeker_id;

        $company = DB::table('managers')
            ->select('comp_id')
            ->where('seeker_id',$seeker_id)
            ->where('level','a')
            ->where('block_admin',False)
            ->first();

        if(empty($company)){
            return view('company.modal.error');
        }

        $spec = DB::table('spec_seeker')
            ->select('spec_name', DB::raw('COUNT(spec_seeker.spec_id) as spec_count'))
            ->leftJoin('spec', 'spec.spec_id', '=', 'spec_seeker.spec_id')
            ->groupby('spec_seeker.spec_id')
            /*  ->having('spec_count', '>',1)*/
            ->orderBy('spec_count', 'DESC')
            ->get();
        $seeker_spec = DB::table('spec_seeker')
            ->join('spec', 'spec.spec_id', '=', 'spec_seeker.spec_id')
            ->where('spec_seeker.seeker_id', '=', $seekers_id)
            ->where('spec_seeker.spec_id', '=', $id)->First();

        return view('seekers.modal.edit.espec')
            ->with('seeker_spec', $seeker_spec)
            ->with('spec', $spec);
    }
    public function update(Request $request, $id)
    {
        $seekers_id = session('seeker_id');
        $spec = trim(strip_tags($request->input('spec')));

        if (empty($spec)) {

            $message = "خطاء في الإدخال";
            $seeker_spec = DB::table('spec_seeker')
                ->join('spec', 'spec.spec_id', '=', 'spec_seeker.spec_id')
                ->where('spec_seeker.seeker_id', '=', $seekers_id)
                ->orderby('spec_seeker.seeker_id', 'DESC')->get();
            $data =[
                "seeker_spec" => $seeker_spec,
            ];

            return  Helpers::showModal($this->pageName,$data,$message);
        }


        $check_spec = DB::table('spec')
            ->select('spec_id')
            ->where('spec_name', '=', $spec)->first();



            if (count($check_spec) == 1) {
                if ($check_spec->spec_id == $id) {
                    $message = "خطاء في الإدخال";
                    $seeker_spec = DB::table('spec_seeker')
                        ->join('spec', 'spec.spec_id', '=', 'spec_seeker.spec_id')
                        ->where('spec_seeker.seeker_id', '=', $seekers_id)
                        ->orderby('spec_seeker.seeker_id', 'DESC')->get();
                    $data =[
                        "seeker_spec" => $seeker_spec,
                    ];

                    return  Helpers::showModal($this->pageName,$data,$message);
                }
                $spec_id = $check_spec->spec_id;
                $check_spec_seeker = DB::table('spec_seeker')
                    ->select('spec_id')
                    ->where('spec_id', '=', $spec_id)
                    ->where('seeker_id', '=', $seekers_id)->first();
                if (count($check_spec_seeker) < 1) {

                    DB::table('spec_seeker')
                        ->where('spec_id', $id)
                        ->where('seeker_id', $seekers_id)
                        ->delete();

                    $saved = DB::table('spec_seeker')->insert([
                        'seeker_id' => $seekers_id,
                        'spec_id' => $spec_id,
                    ]);
                } else {
                    $message = "خطاء في الإدخال";
                    $seeker_spec = DB::table('spec_seeker')
                        ->join('spec', 'spec.spec_id', '=', 'spec_seeker.spec_id')
                        ->where('spec_seeker.seeker_id', '=', $seekers_id)
                        ->orderby('spec_seeker.seeker_id', 'DESC')->get();
                    $data =[
                        "seeker_spec" => $seeker_spec,
                    ];

                    return  Helpers::showModal($this->pageName,$data,$message);
                }
            } else {

                DB::table('spec_seeker')
                    ->where('spec_id', $id)
                    ->where('seeker_id', $seekers_id)
                    ->delete();

                DB::table('spec')->insert([
                    'spec_name' => $spec,
                ]);

                $check_spec = DB::table('spec')
                    ->select('spec_id')
                    ->where('spec_name', '=', $spec)->first();

                if (count($check_spec) == 1) { // Add 3 fadi
                    $spec_id = $check_spec->spec_id;
                    DB::table('spec_seeker')->insert([
                        'seeker_id' => $seekers_id,
                        'spec_id' => $spec_id,
                    ]);


                }
            }

        $message = "";
        $seeker_spec = DB::table('spec_seeker')
            ->join('spec', 'spec.spec_id', '=', 'spec_seeker.spec_id')
            ->where('spec_seeker.seeker_id', '=', $seekers_id)
            ->orderby('spec_seeker.seeker_id', 'DESC')->get();
        $data =[
            "seeker_spec" => $seeker_spec,
        ];

        return  Helpers::showModal($this->pageName,$data,$message);
    }

    public function destroy($user,$id)
    {
        $seekers_id =session('seeker_id');

        $company= Helpers::getDataSeeker('seekerCompany',$seekers_id,false);

        DB::table('spec_company')
            ->where('spec_company_id', $id)
            ->where('comp_id', $company->comp_id)
            ->delete();

        $message = "";
        $company_spec = Helpers::getDataSeeker('spec_company', $company->comp_id, true);

        $data = [
            "company_spec" => $company_spec,
            "user" => $user
        ];

        return Helpers::showModalCompany($this->pageName, $data, $message);
    }
}

<?php

namespace App\Http\Controllers\Seekers;

use Illuminate\Http\Request;
use DB;
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

    public function create()
    {

        return view('seekers.modal.add.aspec');
    }

    public function store(Request $request)
    {
        $id = session('seeker_id');

        $spec = trim(strip_tags($request->input('specSeeker')));

        if (!empty($spec) && $spec !="") {
            $returnedData = Helpers::getRedis('spec', $spec);

            if ($returnedData != "empty") {

                $spec_id = $returnedData;
                DB::table('spec_seeker')->insert([
                    'seeker_id' => $id,
                    'spec_id' => $spec_id,
                ]);
            } else {

                $item = DB::table('spec')->select('spec_id')->where('spec_name', $spec)->first();
                if ($item != null) {
                    $spec_id = $item->spec_id;
                    DB::table('spec_seeker')->insert([
                        'seeker_id' => $id,
                        'spec_id' => $spec_id,
                    ]);
                } else {
                    $spec_id = DB::table('spec')->insertGetId(['spec_name' => $spec]);

                    Helpers::setRedis('spec', $spec . "=" . $spec_id);

                    DB::table('spec_seeker')->insert([
                        'seeker_id' => $id,
                        'spec_id' => $spec_id,
                    ]);
                }

            }
        }
        $message = "";
        $seeker_spec = Helpers::getDataSeeker('spec', $id, true);
        $data = [
            "seeker_spec" => $seeker_spec,
        ];

        return Helpers::showModal($this->pageName, $data, $message);
    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        $seekers_id = session('seeker_id');

        $ed_DataTable = Helpers::getDataSeeker('spec', $seekers_id, false);

        $seeker_spec = null;
        if ($ed_DataTable != null) {
            foreach ($ed_DataTable as $obj) {
                if ($obj->spec_seeker_id == $id) {
                    $seeker_spec = $obj;
                    break;
                }
            }
        }

        return view('seekers.modal.edit.espec')
            ->with('seeker_spec', $seeker_spec);
    }


    public function update(Request $request, $id)
    {
        $seekers_id = session('seeker_id');
        $spec = trim(strip_tags($request->input('spec')));

        if (!empty($spec) && $spec !="") {
            $returnedData = Helpers::getRedis('spec', $spec);
            if ($returnedData != "empty") {
                $spec_id = $returnedData;
                DB::table('spec_seeker')
                    ->where('spec_seeker_id', $id)
                    ->where('seeker_id', $seekers_id)
                    ->update([
                        'spec_id' => $spec_id,
                    ]);

            } else {

                $item = DB::table('spec')->select('spec_id')->where('spec_name', $spec)->first();
                if ($item != null) {
                    $spec_id = $item->spec_id;
                    DB::table('spec_seeker')
                        ->where('spec_seeker_id', $id)
                        ->where('seeker_id', $seekers_id)
                        ->update([
                            'spec_id' => $spec_id,
                        ]);
                } else {

                    $spec_id = DB::table('spec')->insertGetId(['spec_name' => $spec]);
                    Helpers::setRedis('spec', $spec . "=" . $spec_id);

                    DB::table('spec_seeker')
                        ->where('spec_seeker_id', $id)
                        ->where('seeker_id', $seekers_id)
                        ->update([
                            'spec_id' => $spec_id,
                        ]);
                }
            }
        }

        $message = "";
        $seeker_spec = Helpers::getDataSeeker('spec', $id, true);
        var_dump($seeker_spec);
        die();
        $data = [
            "seeker_spec" => $seeker_spec,
        ];

        return Helpers::showModal($this->pageName, $data, $message);
    }

    public function destroy($id)
    {
        $seekers_id = session('seeker_id');
        DB::table('spec_seeker')
            ->where('spec_seeker_id', $id)
            ->where('seeker_id', $seekers_id)
            ->delete();

        $message = "";
        $seeker_spec = Helpers::getDataSeeker('spec', $seekers_id, true);

        $data = [
            "seeker_spec" => $seeker_spec,
        ];

        return Helpers::showModal($this->pageName, $data, $message);
    }
}

<?php

namespace App\Http\Controllers\Seekers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReferenceController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('seekers.modal.add.aref');

    }

    public function store(Request $request)
    {
        $id = Auth::guard('seekers')->user()->seeker_id;

        $ref_name = $request->input('ref_name');
        $ref_adj = $request->input('ref_adj');
        $ref_email = $request->input('ref_email');
        $ref_phone = $request->input('ref_phone');

        DB::table('job_reference')->insert([
            'seeker_id' => $id,
            'ref_name' => $ref_name,
            'ref_adj' => $ref_adj,
            'ref_email' => $ref_email,
            'ref_phone' => $ref_phone,
        ]);
        return redirect('/profile'.'#reference');
    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        $seekers_id = Auth::guard('seekers')->user()->seeker_id;
        $seeker_ref = DB::table('job_reference')
            ->where('seeker_id','=',$seekers_id)
            ->where('ref_id','=',$id)->First();

        return view('seekers.modal.edit.eref')
            ->with('seeker_ref',$seeker_ref);
    }

    public function update(Request $request, $id)
    {
        $seekers_id = Auth::guard('seekers')->user()->seeker_id;

        $ref_name = $request->input('ref_name');
        $ref_adj = $request->input('ref_adj');
        $ref_email = $request->input('ref_email');
        $ref_phone = $request->input('ref_phone');


        DB::table('job_training')
            ->where('train_id', $id)
            ->where('seeker_id', $seekers_id)->update([
                'ref_name' => $ref_name,
                'ref_adj' => $ref_adj,
                'ref_email' => $ref_email,
                'ref_phone' => $ref_phone,
            ]);
        return redirect('/profile'.'#reference');
    }

    public function destroy($id)
    {
        $seekers_id = Auth::guard('seekers')->user()->seeker_id;

        DB::table('job_reference')
            ->where('ref_id',$id)
            ->where('seeker_id',$seekers_id)
            ->delete();

        return redirect('/profile'.'#reference');
    }
}

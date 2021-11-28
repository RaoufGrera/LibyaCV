<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers;

class RedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $drop=  Helpers::ManageRedis('DropRedis');
        $bool=  Helpers::ManageRedis('CreateRedis');
        dump("drop: ".$drop." . create: ".$bool);

    }

    public function createCompany()
    {
        //$drop=  Helpers::ManageRedis('DropRedis');
        $Create=  Helpers::ManageRedis('CreateRedisCompany');
        dump("create: ".$Create);
    }

    public function store(Request $request)
    {
        //
    }



    public function edit($id)
    {
        //
    }

    public function update()
    {
      $bool=  Helpers::searchRedis('CreateRedis',null);

      return $bool;
    }


    public function destroy($id)
    {
        //
    }
}

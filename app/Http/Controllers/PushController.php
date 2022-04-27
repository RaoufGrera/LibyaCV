<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Guest;
use Illuminate\Bus\Queueable;

use Notification;
use App\Notifications\PushDemo;
class PushController extends Controller
{
    use Queueable;

    /**
     * Store the PushSubscription.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
 

    
    public function push(){
      $user = \App\Guest::findOrFail(6831);

      //$user->notify(new \App\Notifications\PushDemo());
        Notification::send($user,new PushDemo); 
      //  return redirect()->back();
    }
    public function store(Request $request){
        $this->validate($request,[
            'endpoint'    => 'required',
            'keys.auth'   => 'required',
            'keys.p256dh' => 'required'
        ]);
        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
        $user = Guest::firstOrCreate([
            'endpoint' => $endpoint
        ]);
        $user->updatePushSubscription($endpoint, $key, $token, $user->id);
      //  Notification::send($user,new PushDemo);

        return response()->json(['success' => true],200);
    }
    
}
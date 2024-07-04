<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Notification as NotificationResource;
use App\Notification;
use App\FcmToken;
use App\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {

        $notifications = Notification::get();
        return NotificationResource::collection($notifications);
    }

    public function create()
    {
        $notification = null;
        return view('notifications.form', compact('notification'));
    }

    public function store(Request $request)
    {

        $user = Auth::guard()->user();

        $rules = [
            'sujet' => 'required'
        ];

        if ($request->get('id') != 'null') {
            $notification = Notification::find($request->get('id'));
        } else {
            $notification = new Notification();
        }

        $validte = $request->validate($rules);
        if ($validte) {

            $notification->sujet =  $request->get('sujet');
            $notification->message =  $request->get('message');
            $nombre_sent = 0;
            $nombre_done = 0;


            $tokens = FcmToken::get();

            foreach ($tokens as $item) {
                if (!$item->token)
                    continue;

                $result = $user->sendPush($notification->sujet, $notification->message, $item->token);
                $result = json_decode($result, true);
                if ($result['success'] == 1)
                    $nombre_done++;
                $nombre_sent++;
            }

            $notification->nombre_sent =  $nombre_sent;
            $notification->nombre_done =  $nombre_done;

            $notification->save();

            if ($notification->save()) {
                return new NotificationResource($notification);
            }
        } else {
        }

        //return redirect('/notifications')->with('success', 'Notification saved!');
    }

    public function show($id)
    {
        $notifications = Notification::where('parent_id', $id)->get();
        return NotificationResource::collection($notifications);
    }

    public function edit($id)
    {
        $notification = Notification::find($id);
        return view('notifications.form', compact('notification'));
    }

    public function destroy($id)
    {

        $notification = Notification::find($id);
        $notification->delete();

        return true;
        //return redirect('/notifications')->with('success', 'Notification deleted!');
    }
}

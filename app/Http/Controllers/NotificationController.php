<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserNotificationRequest;
use App\UserNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = UserNotification::paginate(10);
        return response()->json($notifications);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserNotificationRequest $request)
    {
        $notification = UserNotification::create($request->all());
        return response()->json($notification, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  UserNotification $notification
     * @return \Illuminate\Http\Response
     */
    public function show(UserNotification $notification)
    {
        return response()->json($notification);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\Illuminate\Http\Request $request, int $id)
    {
        //
    }


    /**
     * Update the status of notifications
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(\Illuminate\Http\Request $request, int $id)
    {
        $request->validate([ 'is_read' => 'required' ]);
        $notification = UserNotification::find($id);
        $notification->is_read = $request->is_read;
        $notification->save();
        return  response()->json($notification, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserNotification $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserNotification $notification)
    {
        $notification->delete();
        return response()->json(null, 204);
    }
}

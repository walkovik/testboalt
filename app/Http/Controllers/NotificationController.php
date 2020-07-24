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
     * @OA\Get(
     *   path="/api/notifications",
     *   tags={"Show All Notifications"},
     *   summary="Display all notifications to the user",
     *   @OA\Response(
     *     response=200,
     *     description="Showing all notifications",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Unauthenticated"
     *   )
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $notifications = UserNotification::paginate(10);
        return response()->json($notifications);
    }

    /**
     * Display the specified resource.
     *
     * @OA\Get(
     *   path="/api/notifications/{id}",
     *   tags={"Show Notification"},
     *   summary="Show a notification given its ID",
     *   @OA\Response(
     *     response=200,
     *     description="Shows the notification to the user",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Unauthenticated"
     *   )
     * )
     *
     * @param  UserNotification $notification
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(UserNotification $notification)
    {
        return response()->json($notification);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *   path="/api/notifications",
     *   tags={"Create Notification"},
     *   summary="Create a new notification",
     *   @OA\Parameter(
     *     name="title",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="content",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="user_id",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Notification created succesfully",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Unauthenticated"
     *   )
     * )
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserNotificationRequest $request)
    {
        $notification = UserNotification::create($request->all());
        return response()->json($notification, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Put(
     *   path="/api/notifications/{id}",
     *   tags={"Update Notification"},
     *   summary="Update a notification given its ID",
     *   @OA\Parameter(
     *     name="id",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Notifcation successfully updated",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Unauthenticated"
     *   )
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
            'is_read' => 'required|boolean'
        ]);
        $notification = UserNotification::find($id);
        $notification->title   = $request->title;
        $notification->content = $request->input('content');
        $notification->is_read = $request->is_read;
        $notification->save();
        return response()->json($notification, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *   path="/api/notifications/{id}",
     *   tags={"Delete Notification"},
     *   summary="Delete a notification given its ID",
     *   @OA\Parameter(
     *     name="id",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Response(
     *     response=204,
     *     description="null",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Unauthenticated"
     *   )
     * )
     * @param UserNotification $notification
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(UserNotification $notification)
    {
        $notification->delete();
        return response()->json(null, 204);
    }

    /**
     * Update the status of notifications.
     *
     * @OA\Put(
     *   path="/api/notification-status/{id}",
     *   tags={"Update Notification Status"},
     *   summary="Update the status of a notification given its ID",
     *   @OA\Parameter(
     *     name="is_read",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Notification Status updated successfully",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="unauthenticated"
     *   )
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, int $id)
    {
        $request->validate(['is_read' => 'required']);
        $notification = UserNotification::find($id);
        $notification->is_read = $request->is_read;
        $notification->save();
        return  response()->json($notification, 200);
    }
}

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
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
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
     * Update the status of notifications.
     *
     * @OA\Put(
     *     path="/api/updateNotificationStatus/{id}",
     *     tags={"Update Notification Status"},
     *     summary="Update the status of a notification given its ID",
     *      @OA\Parameter(
     *        name="is_read",
     *        in="query",
     *        required=true,
     *        @OA\Schema(
     *           type="string"
     *        )
     *      ),
     *     @OA\Parameter(
     *        name="id",
     *        in="query",
     *        required=true,
     *        @OA\Schema(
     *           type="string"
     *        )
     *      ),
     *     @OA\Response(
     *      response=200,
     *      description="Notification Status updated successfully",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *       )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="unauthenticated"
     *     )
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

    /**
     * Remove the specified resource from storage.
     *
     * @param UserNotification $notification
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(UserNotification $notification)
    {
        $notification->delete();
        //return response()->json(['message' => 'Deleted successfully'], 200);
        return response()->json(null, 204);
    }
}

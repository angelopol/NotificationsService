<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification as NotificationModel;
use App\Notifications\GenericNotification;
use Illuminate\Support\Facades\Notification;

class NotificationsController extends Controller
{
    private function ValidateNotification($request){
        $validated = $request->validate([
            'title' => 'required|string|max:500',
            'content' => 'required|string',
            'email' => 'required|email|max:500',
            'action' => 'nullable|string|max:500',
            'url' => 'nullable|string',
            'status' => 'nullable|string',
            'try' => 'nullable|integer',
        ]);
        return $validated;
    }

    private function SendNotification($notification){
        try {
            Notification::route('mail', $notification->email)->notify(new GenericNotification($notification));
        } catch (\Exception $e) {
            $notification->status = 'failed';
            $notification->save();
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = NotificationModel::all();
        if ($notifications->isEmpty()) {
            return response()->json(['message' => 'No notifications found'], 404);
        }
        return response()->json($notifications, 200);
    }

    /**
     * Display a listing of pending notifications.
     */
    public function IndexPending()
    {
        $notifications = NotificationModel::where('status', 'pending')->get();
        if ($notifications->isEmpty()) {
            return response()->json(['message' => 'No pending notifications found'], 404);
        }
        return response()->json($notifications, 200);
    }

    /**
     * Display a listing of sent notifications.
     */
    public function IndexSent()
    {
        $notifications = NotificationModel::where('status', 'sent')->get();
        if ($notifications->isEmpty()) {
            return response()->json(['message' => 'No sent notifications found'], 404);
        }
        return response()->json($notifications, 200);
    }

    /**
     * Display a listing of failed notifications.
     */
    public function IndexFailed()
    {
        $notifications = NotificationModel::where('status', 'pending')->where('try', '>', 1)->get();
        if ($notifications->isEmpty()) {
            return response()->json(['message' => 'No failed notifications found'], 404);
        }
        return response()->json($notifications, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->ValidateNotification($request);
        $notification = NotificationModel::create($validated);
        $this->SendNotification($notification);

        return response()->json($notification, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $notification = NotificationModel::find($id);
        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }
        return response()->json($notification, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $notification = NotificationModel::find($id);
        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }
        
        $validated = $this->ValidateNotification($request);
        $notification->update($validated);
        $this->SendNotification($notification);
        
        return response()->json($notification, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notification = NotificationModel::find($id);
        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }
        $notification->delete();
        return response()->json(['message' => 'Notification deleted'], 200);
    }

    /**
     * Display notifications for a specific user.
     */
    public function ShowUser(string $email)
    {
        $notifications = NotificationModel::where('email', $email)->get();
        if ($notifications->isEmpty()) {
            return response()->json(['message' => 'No notifications found for this user'], 404);
        }
        return response()->json($notifications, 200);
    }

    /**
     * Display pending notifications for a specific user.
     */
    public function ShowUserPending(string $email)
    {
        $notifications = NotificationModel::where('email', $email)->where('status', 'pending')->get();
        if ($notifications->isEmpty()) {
            return response()->json(['message' => 'No pending notifications found for this user'], 404);
        }
        return response()->json($notifications, 200);
    }

    /**
     * Display sent notifications for a specific user.
     */
    public function ShowUserSent(string $email)
    {
        $notifications = NotificationModel::where('email', $email)->where('status', 'sent')->get();
        if ($notifications->isEmpty()) {
            return response()->json(['message' => 'No sent notifications found for this user'], 404);
        }
        return response()->json($notifications, 200);
    }

    /**
     * Display failed notifications for a specific user.
     */
    public function ShowUserFailed(string $email)
    {
        $notifications = NotificationModel::where('email', $email)->where('status', 'pending')->where('try', '>', 1)->get();
        if ($notifications->isEmpty()) {
            return response()->json(['message' => 'No failed notifications found for this user'], 404);
        }
        return response()->json($notifications, 200);
    }
}
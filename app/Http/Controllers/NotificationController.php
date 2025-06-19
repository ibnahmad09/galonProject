<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Kirim Notifikasi ke User
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'type' => 'required|string',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        Notification::create([
            'user_id' => $request->user_id,
            'type' => $request->type,
            'message' => $request->message,
        ]);

        return response()->json(['success' => 'Notifikasi terkirim']);
    }

    // Tandai Notifikasi sebagai Dibaca
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->is_read = true;
        $notification->save();
        return redirect()->back();
    }
}
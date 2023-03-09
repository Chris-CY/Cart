<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function read(Request $request)
    {
        $ids = Notification::all()->pluck('id')->toArray();
        Notification::whereIn("id", $ids)->update(['status' => 'R']);

        return response()->json(['success' => 'The notification status updated.']);
    }
}

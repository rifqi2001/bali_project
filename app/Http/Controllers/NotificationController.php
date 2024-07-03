<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Customer;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return view('notifications.index', compact('notifications'));
    }

    public function create()
    {
        return view('notifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'message' => 'required|string'
        ]);

        Notification::create([
            'user_id' => $request->user_id,
            'message' => $request->message,
            'title' => $request->title,
        ]);

        return redirect()->route('notifications.index')->with('success', 'Notification sent successfully');
    }

    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        return view('notifications.show', compact('notification'));
    }

    public function edit($id)
    {
        $notification = Notification::findOrFail($id);
        return view('notifications.edit', compact('notification'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'message' => 'required|string'
        ]);

        $notification = Notification::findOrFail($id);
        $notification->update([
            'user_id' => $request->user_id,
            'message' => $request->message,
            'title' => $request->title,
        ]);

        return redirect()->route('notifications.index')->with('success', 'Notification updated successfully');
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully');
    }
}

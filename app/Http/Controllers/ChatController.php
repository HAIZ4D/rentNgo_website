<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::with('admin')->orderBy('created_at')->get();
        return view('admin.admin_chat', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Message::create([
            'admin_id' => Auth::guard('admin')->id(),  // Assuming you're using admin guard
            'content' => $request->content,
        ]);

        return redirect()->back();
    }
}

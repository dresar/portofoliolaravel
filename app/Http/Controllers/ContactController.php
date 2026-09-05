<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'subject' => 'nullable|max:255',
            'message' => 'required|min:10',
        ]);

        Message::create($validated);

        return back()->with('success', 'Pesan Anda berhasil dikirim! Terima kasih.');
    }
}


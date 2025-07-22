<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ]);

        Subscriber::create(['email' => $request->email]);
        // Optional: Kirim email konfirmasi di sini (pakai mailable jika mau)

        return back()->with('success', 'Thank you for subscribing!');
    }
}

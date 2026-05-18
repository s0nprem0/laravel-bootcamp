<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    public function index()
    {
        $chirps = Chirp::with('user')
            ->latest()
            ->take(50)  // Limit to 50 most recent chirps
            ->get();

        return view('home', ['chirps' => $chirps]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ], [
            'message.required' => 'Please write something to chirp!',
            'message.max' => 'Your chirp is too long! keep it under 255 characters.',
        ]);

        // Create the chirp (no user for now, auth later)
        \App\Models\Chirp::create([
            'message' => $validated['message'],
            'user_id' => null, // No user for now, auth later
        ]);

        return redirect('/')->with('success', 'Chirp created!');
    }
}
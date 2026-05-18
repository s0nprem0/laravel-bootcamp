<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            Rule::unique('chirps')->where(function ($query) {
                return $query->where('user_id', auth()->id());
            }),
        ], [
            'message.required' => 'Please write something to chirp!',
            'message.max' => 'Your chirp is too long! keep it under 255 characters.',
            'message.unique' => 'You have already chirped that message!',
        ]);

        // Create the chirp (no user for now, auth later)
        \App\Models\Chirp::create([
            'message' => $validated['message'],
            'user_id' => null, // No user for now, auth later
        ]);

        return redirect('/')->with('success', 'Chirp created!');
    }

    public function edit(Chirp $chirp)
    {
        // add auth in lesson 11
        return view('chirps.edit', ['chirp' => $chirp]);
    }

    public function update(Request $request, Chirp $chirp)
    {
        // Validate
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // Update
        $chirp->update($validated);

        return redirect('/')->with('success', 'Chirp updated!');
    }

    public function destroy(Chirp $chirp)
    {
        $chirp->delete();

        return redirect('/')->with('success', 'Chirp deleted!');
    }
}
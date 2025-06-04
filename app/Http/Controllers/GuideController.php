<?php
// app/Http/Controllers/GuideController.php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuideController extends Controller
{
    // Admin creates guide
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|unique:guides,mobile_number',
            'date_of_birth' => 'nullable|date',
            'email' => 'nullable|email',
            'whatsapp_number' => 'nullable|string',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        $guide = Guide::create($data);

        // TODO: Send WhatsApp welcome message + app links here

        return response()->json(['message' => 'Guide registered successfully.', 'guide' => $guide]);
    }

    public function index()
    {
        return Guide::with('visits', 'redemptions')->get();
    }

    public function show($id)
    {
        return Guide::with('visits', 'redemptions')->findOrFail($id);
    }

    public function destroy($id)
    {
        $guide = Guide::findOrFail($id);
        $guide->delete();
        return response()->json(['message' => 'Guide deleted.']);
    }

    public function login(Request $request)
    {
        
    }

    public function logout()
    {
        Auth::guard('guide')->logout();
        return response()->json(['message' => 'Logged out.']);
    }
}

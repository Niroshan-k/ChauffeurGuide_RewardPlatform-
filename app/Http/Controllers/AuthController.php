<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Guide;
use App\Models\Admin;

class AuthController extends Controller
{
    /**
     * Guide Login
     */
    public function guideLogin(Request $request)
    {
        $request->validate([
            'mobile' => 'required|string',
            'password' => 'required|string',
        ]);

        $guide = Guide::where('mobile', $request->mobile)->first();

        if (! $guide || ! Hash::check($request->password, $guide->password)) {
            throw ValidationException::withMessages([
                'mobile' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $guide->createToken('guide-token')->plainTextToken;

        return response()->json([
            'user' => $guide,
            'token' => $token,
        ]);
    }

    /**
     * Admin Login
     */
    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $admin->createToken('admin-token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'admin' => $admin,
        ]);
    }

}

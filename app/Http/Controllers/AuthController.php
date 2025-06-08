<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registershow()
    {
        return view('register');
    }
    public function registerstore(Request $request)
    {
    //    // dd($request);
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'phone' => 'required|string',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'phone' => $request->phone,
    //         'password' => Hash::make($request->password),
    //     ]);
    // // Store phone in session for OTP page
    // session(['phone' => $user->phone]);

    // // Redirect to otp verification page (create this view)
    // return redirect()->route('otp.verify');

    }
}

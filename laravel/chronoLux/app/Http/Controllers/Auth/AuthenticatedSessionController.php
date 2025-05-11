<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;

use Illuminate\Http\RedirectResponse;


class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|org|net|sk|cz|eu)$/'
            ],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            (new CartController)->transferSessionCart();

            // distinguish admin from user
            $redirectUrl = $user->role === 'admin' ? route('admin.dashboard') : route('profile');

            return response()->json(['success' => true, 'redirect' => $redirectUrl]);
        }

        return response()->json(['success' => false, 'message' => 'Email or password are incorrect.'], 422);
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

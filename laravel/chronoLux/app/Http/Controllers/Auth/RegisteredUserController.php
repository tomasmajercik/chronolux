<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        try {
            $request->validate([
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors()); 
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'customer',
        ]);

        event(new Registered($user));

        // shout refresh the token and session
        session()->invalidate();
        session()->regenerateToken();

        Auth::login($user);

        // return redirect()->route('profile');
        return response()->redirect('profile');//->with('success', 'Registration successful! Welcome to ChronoLux!');
    }
}

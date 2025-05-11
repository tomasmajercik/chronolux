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

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\CartController;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // Validate input fields
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|org|net|sk|cz|eu)$/', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);           

        // If validation passes, create a new user
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'customer',
        ]);

        // Trigger the Registered event
        event(new Registered($user));

        // Log the user in after registration
        Auth::login($user);
        (new CartController)->transferSessionCart();

        return response()->json(['success' => true]);
        // return redirect('/profile');
        // return response(); //->redirect('profile');//->with('success', 'Registration successful! Welcome to ChronoLux!');
    }
}

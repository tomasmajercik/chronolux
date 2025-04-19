<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile', ['user' => $user]);
    }
    public function editName()
    {
        $user = Auth::user();
        return view('profile', ['user' => $user, 'isEditingName' => true]);
    }
    public function updateName(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $user->name = $request->input('name');
            $user->save();

            return redirect()->route('profile');
        }

        return redirect()->route('profile')->withErrors(['error' => 'User not logged in.']);
    }
}

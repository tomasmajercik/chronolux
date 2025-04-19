<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Address;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $memberSince = $user->created_at->diffInMonths(now());

        return view('profile', [
            'user' => $user,
            'memberSince' => floor($memberSince)
        ]);
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

    // edit address modal
    public function updateAddress(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
        ]);

        $existingAddress = Address::where('city', $validated['city'])
        ->where('country', $validated['country'])
        ->where('address', $validated['address'])
        ->where('postal_code', $validated['postal_code'])
        ->first();

        if ($existingAddress) {
            $user->default_address = $existingAddress->id;
        } 
        else { // Create a new address if it doesn't exist
            $newAddress = new Address();
            $newAddress->city = $validated['city'];
            $newAddress->country = $validated['country'];
            $newAddress->address = $validated['address'];
            $newAddress->postal_code = $validated['postal_code'];
            $newAddress->save();

    
            $user->default_address = $newAddress->id;
        }

        $user->save();
        return redirect()->route('profile')->with('success', 'Address successfully changed.');

    }
    public function updateContact(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'phone-number' => 'nullable|string|max:255',
            'email' => 'required|string|max:255'
        ]);

        $user->phone_number = $validated['phone-number'];
        $user->email = $validated['email'];
        $user->save();
        return redirect()->route('profile')->with('success', 'Contact information successfully changed.');

    }   
}

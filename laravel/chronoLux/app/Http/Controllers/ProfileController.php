<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Address;


class ProfileController extends Controller
{

    public function show()
    {
        $user = Auth::user();

        $memberSince = $user->created_at->diffInMonths(now());
        $orderCount = $user->orders()->whereNotIn('status', ['pending'])->count();
        $lastOrder = $user->orders()->whereNotIn('status', ['pending'])->latest()->first();
        $lastOrderDaysAgo = $lastOrder ? $lastOrder->created_at->diffInDays(now()) : null;
        $moneySpent = $user->orders()->whereNotIn('status', ['pending'])->sum('total_price');

        $orders = $user->orders()
            ->whereNotIn('status', ['pending'])
            ->with('orderItems.productVariant.product.coverImage') 
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($order) {
                return [
                    'date' => $order->created_at->format('Y-m-d'),
                    'images' => $order->orderItems->map(function ($item) {
                        return $item->productVariant?->product?->coverImage?->image_path;
                    })->filter()->take(3)->values()->toArray(), // max 3 imgs
                    'status' => $order->status,
                    'price' => $order->total_price,
                    'id' => $order->id,
                ];
            });

    

        return view('profile', [
            'user' => $user,
            'memberSince' => floor($memberSince),
            'orderCount' => $orderCount,
            'lastOrderDaysAgo' => $lastOrderDaysAgo !== null ? floor($lastOrderDaysAgo) : null,
            'moneySpent' => $moneySpent,
            'orders' => $orders,
        ]);
    }

    public function editName()
    {
        $user = Auth::user();

        $memberSince = $user->created_at->diffInMonths(now());
        $orderCount = $user->orders()->count();
        $lastOrder = $user->orders()->latest()->first();
        $lastOrderDaysAgo = $lastOrder ? $lastOrder->created_at->diffInDays(now()) : null;
        $moneySpent = $user->orders()->sum('total_price');
        
        $orders = $user->orders()
            ->whereNotIn('status', ['pending'])
            ->with('orderItems.productVariant.product.coverImage') 
            ->latest()
            ->get()
            ->map(function ($order) {
                return [
                    'date' => $order->created_at->format('Y-m-d'),
                    'images' => $order->orderItems->map(function ($item) {
                        return $item->productVariant?->product?->coverImage?->image_path;
                    })->filter()->take(3)->values()->toArray(), // max 3 imgs
                    'status' => $order->status,
                    'price' => $order->total_price,
                    'id' => $order->id
                ];
            });


        return view('profile', [
            'user' => $user,
            'isEditingName' => true,
            'memberSince' => floor($memberSince),
            'orderCount' => $orderCount,
            'lastOrderDaysAgo' => $lastOrderDaysAgo !== null ? floor($lastOrderDaysAgo) : null,
            'moneySpent' => $moneySpent,
            'orders' => $orders,
        ]);
    }
    public function updateName(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $request->validate([
                'name' => 'nullable|string|max:255',
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

        $validated = Validator::make($request->all(), [
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => [
                'required',
                'regex:/^\d{3}\s?\d{2}$/'
            ],
        ])->validateWithBag('address');
        

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

        $validated = Validator::make($request->all(), [
            'phone-number' => [
                'nullable',
                'regex:/^(?:\+421\s?\d{3}|\d{4})\s?\d{3}\s?\d{3}$/'
            ],
            'email' => [
                'required',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|org|net|sk|cz|eu)$/'
            ],
        ])->validateWithBag('contact');

        try {
            if ($user->email !== $validated['email']) 
            {
                if (\App\Models\User::where('email', $validated['email'])->exists()) {
                    return redirect()->route('profile')->withErrors(['email' => 'This email is already taken.']);
                }
            }

            $user->phone_number = $validated['phone-number'];
            $user->email = $validated['email'];
            $user->save();

            return redirect()->route('profile')->with('success', 'Contact information successfully changed.');
        } catch (\Exeption $e) {
            return redirect()->route('profile')->withErrors(['email' => 'An error occurred while updating contact information.']);
        }
    }   
    public function updateEmail(Request $request)
    {
        $user = Auth::user();
    
        $validated = $request->validate([
            'email' => [
                'required',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|org|net|sk|cz|eu)$/'
            ]
        ]);
    
        try {
            if ($user->email !== $validated['email']) 
            {
                if ($user::where('email', $validated['email'])->exists()) {
                    return response()->json(['errors' => ['email' => ['This email is already taken.']]], 422);
                }
            }

            $user->email = $validated['email'];
            $user->save();

            return response()->json(['message' => 'Email successfully updated.']);
        } catch (\Exeption $e) {
            return response()->json(['errors' => ['email' => ['An error occurred while updating email.']]], 500);
        }
    }
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return response()->json(['errors' => ['current_password' => ['The current password is incorrect.']]], 422);
        }

        try {
            $user->password = Hash::make($validated['new_password']);
            $user->save();

            return response()->json(['message' => 'Password successfully updated.']);
        } catch (\Exception $e) {
            return response()->json(['errors' => ['password' => ['An error occurred while updating your password.']]], 500);
        }

    }
}

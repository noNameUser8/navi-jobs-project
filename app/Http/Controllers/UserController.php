<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        if (!in_array(Auth::user()->role, ['admin', 'office_manager'])) {
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }

        return view('users.create');
    }

    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'office_manager'])) {
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:255',
        'email' => 'required|email|unique:users,email',
        'role' => 'required|in:admin,office_manager,worker,client',
        'organization_id' => 'nullable|exists:organizations,id',
        'password' => 'required|string|min:8|confirmed',
    ]);

    \Log::info('User validation passed', $validated);

    $user = User::create([
        'name' => $validated['name'],
        'last_name' => $validated['last_name'] ?? null,
        'phone' => $validated['phone'] ?? null,
        'email' => $validated['email'],
        'role' => $validated['role'],
        'organization_id' => $validated['organization_id'] ?? null,
        'password' => Hash::make($validated['password']), 
    ]);

    \Log::info('User created', ['user' => $user]);

    return redirect()->route('dashboard')->with('success', 'User added successfully!');
}

}

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
        $authUser = Auth::user();

        if ($authUser->role === 'office_manager' && !$authUser->organization_id) {
            return redirect()->route('organizations.create')->with('error', 'You must create an organization before adding users.');
        }

        if (!in_array($authUser->role, ['admin', 'office_manager'])) {
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }

        $allowedRoles = ['worker', 'office_manager'];
        if ($authUser->role === 'office_manager') {
            $allowedRoles = ['worker'];
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:' . implode(',', $allowedRoles),
            'password' => 'required|string|min:8|confirmed',
        ]);

        $organizationId = ($authUser->role === 'office_manager') ? $authUser->organization_id : null;

        $user = User::create([
            'name' => $validated['name'],
            'last_name' => $validated['last_name'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'],
            'role' => $validated['role'],
            'organization_id' => $organizationId,
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'User added successfully!');
    }

    public function index()
    {
        $authUser = Auth::user();
        
        if ($authUser->role === 'admin') {
            $users = User::with('organization')->get();
        } else {
            $users = User::with('organization')->where('organization_id', $authUser->organization_id)->get();
        }

        return view('users.index', compact('users'));
    }
}

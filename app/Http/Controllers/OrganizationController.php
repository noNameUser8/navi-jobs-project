<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    public function create()
    {
        if (!in_array(Auth::user()->role, ['admin', 'office_manager'])) {
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }

        return view('organizations.create');
    }

    public function store(Request $request)
    {

        if (!in_array(Auth::user()->role, ['admin', 'office_manager'])) {
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }
    
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:organizations,name',
            'description' => 'nullable|string',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);
    
        $organization = Organization::create($validated);
    
        if (Auth::user()->role === 'office_manager') {
            Auth::user()->update(['organization_id' => $organization->id]);
        }
    
        return redirect()->route('dashboard')->with('success', 'Organization created successfully!');
    }
    public function index()
    {
        $authUser = Auth::user();

        if ($authUser->role === 'admin') {
            $organizations = Organization::all();
        } else {
            $organizations = Organization::where('id', $authUser->organization_id)->get();
        }

        return view('organizations.index', compact('organizations'));
    }

    public function edit(Organization $organization)
    {
        $authUser = Auth::user();

        if ($authUser->role !== 'admin' && $authUser->organization_id !== $organization->id) {
            return redirect()->route('organizations.index')->with('error', 'Access denied.');
        }

        return view('organizations.edit', compact('organization'));
    }

    public function update(Request $request, Organization $organization)
    {
        $authUser = Auth::user();

        if ($authUser->role !== 'admin' && $authUser->organization_id !== $organization->id) {
            return redirect()->route('organizations.index')->with('error', 'Access denied.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $organization->update($validated);

        return redirect()->route('organizations.index')->with('success', 'Organization updated successfully!');
    }

    public function destroy(Organization $organization)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('organizations.index')->with('error', 'Access denied.');
        }

        $organization->delete();

        return redirect()->route('organizations.index')->with('success', 'Organization deleted successfully!');
    }
}

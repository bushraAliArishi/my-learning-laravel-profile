<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToolController extends Controller
{
    public function store(Request $request)
    {
        // Admin role verification
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/login')->with('error', 'Unauthorized action');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255|unique:tools,name',
            'logo' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,svg',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('tools', 'public');
        }

        Tool::create([
            'name' => $data['name'],
            'logo' => $logoPath ? "/storage/{$logoPath}" : null,
            'user_id' => Auth::id() // Track which admin created the tool
        ]);

        return back()->with('success', 'Tool created successfully');
    }
}

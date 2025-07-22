<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function store(Request $request)
    {
        // Check if user is authenticated and has admin role
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $data = $request->validate([
            'name'  => 'required|string|max:255|unique:tags,name',
            'color' => 'required|string|size:7',
        ]);

        Tag::create([
            'name'      => $data['name'],
            'color_hex' => $data['color'],
            'user_id'   => Auth::id() // Associate tag with current user
        ]);

        return back()->with('success', 'Tag created successfully');
    }
}
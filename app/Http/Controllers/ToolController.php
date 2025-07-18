<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;

class ToolController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:tools,name',
            'logo' => 'nullable|image|max:2048',
        ]);

        $logoPath = $request->hasFile('logo')
            ? $request->file('logo')->store('tools','public')
            : null;

        Tool::create([
            'name' => $data['name'],
            'logo' => $logoPath ? "/storage/{$logoPath}" : null,
        ]);

        return back();
    }
}

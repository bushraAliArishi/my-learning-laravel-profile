<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255|unique:tags,name',
            'color' => 'required|string|size:7',
        ]);

        Tag::create([
            'name'      => $data['name'],
            'color_hex' => $data['color'],
        ]);

        return back();
    }
}

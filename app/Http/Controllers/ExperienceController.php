<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;
use App\Models\Tag;    
use App\Models\Tool;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::with(['skills','achievements','tools'])
                          ->orderBy('start_date','desc')
                          ->paginate(4);

        return view('experience.index', compact('experiences'))
               ->with(['title'=>'My Experience','heading'=>'Experience']);
    }

    public function create()
    {
        if(Auth::guest() || Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $allTools = Tool::orderBy('name')->get();
        return view('experience.create', compact('allTools'))
               ->with(['title'=>'Add Experience','heading'=>'Add Experience']);
    }

    public function show(Experience $experience)
    {
        return view('experience.show', compact('experience'));
    }

    public function store(Request $request)
    {
        if(Auth::guest() || Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $data = $request->validate([
            'slug'         => 'required|string|max:255|unique:experiences,slug',
            'title'        => 'required|string|max:255',
            'company'      => 'required|string|max:255',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'details'      => 'required|string',
            'skills'       => 'array',
            'skills.*'     => 'nullable|string|max:255',
            'achievements' => 'array',
            'achievements.*'=> 'nullable|string|max:255',
            'tools'        => 'array',
            'tools.*'      => 'exists:tools,id',
        ]);

        $exp = Experience::create([
            'slug'       => $data['slug'],
            'title'      => $data['title'],
            'company'    => $data['company'],
            'start_date' => $data['start_date'],
            'end_date'   => $data['end_date'] ?? null,
            'details'    => $data['details'],
            'user_id'    => Auth::id()
        ]);

        foreach ($data['skills'] as $skill) {
            if ($skill) {
                $exp->skills()->create(['skill_name'=>$skill]);
            }
        }

        foreach ($data['achievements'] as $ach) {
            if ($ach) {
                $exp->achievements()->create(['description'=>$ach]);
            }
        }

        $exp->tools()->sync($data['tools'] ?? []);

        return redirect()->route('experience.index')
                         ->with('success','Experience added.');
    }

    public function edit(Experience $experience)
    {
        if(Auth::guest() || Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $allTools = Tool::orderBy('name')->get();
        return view('experience.edit', compact('experience','allTools'))
               ->with(['title'=>'Edit Experience','heading'=>'Edit Experience']);
    }

    public function update(Request $request, Experience $experience)
    {
        if(Auth::guest() || Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $data = $request->validate([
            'slug'         => "required|string|max:255|unique:experiences,slug,{$experience->id}",
            'title'        => 'required|string|max:255',
            'company'      => 'required|string|max:255',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'details'      => 'required|string',
            'skills'       => 'array',
            'skills.*'     => 'nullable|string|max:255',
            'achievements' => 'array',
            'achievements.*'=> 'nullable|string|max:255',
            'tools'        => 'array',
            'tools.*'      => 'exists:tools,id',
        ]);

        $experience->update([
            'slug'       => $data['slug'],
            'title'      => $data['title'],
            'company'    => $data['company'],
            'start_date' => $data['start_date'],
            'end_date'   => $data['end_date'] ?? null,
            'details'    => $data['details'],
        ]);

        $experience->skills()->delete();
        foreach ($data['skills'] as $skill) {
            if ($skill) {
                $experience->skills()->create(['skill_name'=>$skill]);
            }
        }

        $experience->achievements()->delete();
        foreach ($data['achievements'] as $ach) {
            if ($ach) {
                $experience->achievements()->create(['description'=>$ach]);
            }
        }

        $experience->tools()->sync($data['tools'] ?? []);

        return redirect()->route('experience.index')
                         ->with('success','Experience updated.');
    }

    public function destroy(Experience $experience)
    {
        if(Auth::guest() || Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $experience->delete();
        return redirect()->route('experience.index')
                         ->with('success','Experience deleted.');
    }
}
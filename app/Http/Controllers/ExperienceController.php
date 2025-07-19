<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Experience;
use App\Models\Tool;

class ExperienceController extends Controller
{
    public function index()
    {
        // Paginate instead of get() so links() works
        $experiences = Experience::with(['skills','achievements','tools'])
                         ->orderBy('start_date', 'desc')
                         ->paginate(10);

        return view('experience.index', compact('experiences'))
               ->with([
                   'title'   => 'All Experience',
                   'heading' => 'Learn More About Me',
               ]);
    }

    public function create()
    {
        $allTools = Tool::orderBy('name')->get();

        return view('experience.create', compact('allTools'))
               ->with([
                   'title'   => 'Add New Experience',
                   'heading' => 'Create an Experience Entry',
               ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'details'     => 'required|string',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date',
            'tools'       => 'array',
            'tools.*'     => 'exists:tools,id',
        ]);

        $exp = Experience::create([
            'title'      => $data['title'],
            'company'    => $data['company'],
            'details'    => $data['details'],
            'start_date' => $data['start_date'] ?? null,
            'end_date'   => $data['end_date']   ?? null,
        ]);

        $exp->slug = "{$exp->id}-" . Str::slug("{$exp->company} {$exp->title}");
        $exp->save();

        $exp->tools()->sync($data['tools'] ?? []);

        return redirect()->route('experience.index');
    }

    public function show(Experience $experience)
    {
        return view('experience.show', ['exp' => $experience])
               ->with([
                   'title'   => $experience->title,
                   'heading' => "{$experience->company} • {$experience->period}",
               ]);
    }

    public function edit(Experience $experience)
    {
        $allTools = Tool::orderBy('name')->get();

        return view('experience.edit', [
                  'exp'      => $experience,
                  'allTools' => $allTools,
               ])
               ->with([
                   'title'   => $experience->title,
                   'heading' => "Edit Experience: {$experience->title}",
               ]);
    }

    public function update(Request $request, Experience $experience)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'details'     => 'required|string',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date',
            'tools'       => 'array',
            'tools.*'     => 'exists:tools,id',
        ]);

        $experience->update([
            'title'      => $data['title'],
            'company'    => $data['company'],
            'details'    => $data['details'],
            'start_date' => $data['start_date'] ?? null,
            'end_date'   => $data['end_date']   ?? null,
        ]);

        $experience->slug = "{$experience->id}-" . Str::slug("{$data['company']} {$data['title']}");
        $experience->save();

        $experience->tools()->sync($data['tools'] ?? []);

        return redirect()->route('experience.show', $experience);
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('experience.index');
    }
}

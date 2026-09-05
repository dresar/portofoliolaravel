<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('start_date', 'desc')->get();
        return view('admin.experiences.index', compact('experiences'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|max:255',
            'role' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable',
            'location' => 'nullable|max:255',
            'order' => 'nullable|integer',
        ]);

        Experience::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Experience berhasil ditambahkan.',
            'redirect' => route('admin.experiences.index'),
        ]);
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'company' => 'required|max:255',
            'role' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable',
            'location' => 'nullable|max:255',
            'order' => 'nullable|integer',
        ]);

        $experience->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Experience berhasil diupdate.',
            'redirect' => route('admin.experiences.index'),
        ]);
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        return response()->json([
            'success' => true,
            'message' => 'Experience berhasil dihapus.',
        ]);
    }
}


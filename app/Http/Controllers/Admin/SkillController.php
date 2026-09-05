<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('order')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'proficiency_level' => 'required|integer|min:0|max:100',
            'icon' => 'nullable|max:255',
            'category' => 'nullable|max:255',
            'order' => 'nullable|integer',
        ]);

        Skill::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Skill berhasil ditambahkan.',
            'redirect' => route('admin.skills.index'),
        ]);
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'proficiency_level' => 'required|integer|min:0|max:100',
            'icon' => 'nullable|max:255',
            'category' => 'nullable|max:255',
            'order' => 'nullable|integer',
        ]);

        $skill->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Skill berhasil diupdate.',
            'redirect' => route('admin.skills.index'),
        ]);
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return response()->json([
            'success' => true,
            'message' => 'Skill berhasil dihapus.',
        ]);
    }
}


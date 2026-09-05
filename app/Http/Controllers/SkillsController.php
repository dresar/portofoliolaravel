<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function index()
    {
        return view('skills', [
            'skills' => Skill::orderBy('order')->get(),
        ]);
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        return view('experience', [
            'experiences' => Experience::orderBy('start_date', 'desc')->get(),
        ]);
    }
}


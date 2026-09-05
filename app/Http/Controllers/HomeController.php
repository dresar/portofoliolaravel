<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'featuredProjects' => Project::where('is_featured', true)->orderBy('order')->limit(3)->get(),
        ]);
    }
}


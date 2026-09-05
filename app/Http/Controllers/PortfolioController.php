<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();
        
        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
        
        $projects = $query->orderBy('order')->get();
        $categories = Project::distinct()->pluck('category');
        
        return view('portfolio', [
            'projects' => $projects,
            'categories' => $categories,
            'selectedCategory' => $request->get('category', 'all'),
        ]);
    }
}


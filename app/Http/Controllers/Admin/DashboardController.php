<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'services' => Service::count(),
            'posts' => Post::count(),
            'unread_messages' => Message::where('is_read', false)->count(),
            'recent_projects' => Project::latest()->limit(5)->get(),
            'recent_posts' => Post::latest()->limit(5)->get(),
            'recent_messages' => Message::latest()->limit(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}


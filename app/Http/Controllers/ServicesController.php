<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        return view('services', [
            'services' => Service::orderBy('order')->get(),
        ]);
    }
}


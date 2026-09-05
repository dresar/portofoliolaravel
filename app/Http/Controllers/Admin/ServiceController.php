<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'icon' => 'nullable|max:255',
            'order' => 'nullable|integer',
        ]);

        Service::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Service berhasil ditambahkan.',
            'redirect' => route('admin.services.index'),
        ]);
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'icon' => 'nullable|max:255',
            'order' => 'nullable|integer',
        ]);

        $service->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Service berhasil diupdate.',
            'redirect' => route('admin.services.index'),
        ]);
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service berhasil dihapus.',
        ]);
    }
}


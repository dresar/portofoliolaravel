@extends('admin.layouts.app')

@section('title', 'Projects')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Projects</h1>
        <a href="{{ route('admin.projects.create') }}" 
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
            + Tambah Project
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Featured</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($projects as $project)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" 
                                     alt="{{ $project->title }}" 
                                     class="w-16 h-16 object-cover rounded-lg border border-gray-200">
                            @else
                                <div class="w-16 h-16 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-lg"></div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="text-sm font-medium text-gray-900">{{ $project->title }}</div>
                                @if(!$project->is_active)
                                    <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-100 text-gray-600">Inactive</span>
                                @endif
                            </div>
                            <div class="text-sm text-gray-500 mt-1">
                                {{ Str::limit($project->short_description ?? $project->description, 50) }}
                            </div>
                            @if($project->technologies)
                                <div class="flex flex-wrap gap-1 mt-2">
                                    @foreach(array_slice($project->technologies, 0, 3) as $tech)
                                        <span class="px-2 py-0.5 text-xs bg-blue-100 text-blue-700 rounded">{{ $tech }}</span>
                                    @endforeach
                                    @if(count($project->technologies) > 3)
                                        <span class="px-2 py-0.5 text-xs text-gray-500">+{{ count($project->technologies) - 3 }}</span>
                                    @endif
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                {{ $project->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col gap-1">
                                @if($project->is_featured)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Featured</span>
                                @endif
                                @if($project->views_count > 0)
                                    <span class="text-xs text-gray-500">{{ $project->views_count }} views</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.projects.edit', $project) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                                <button data-delete="{{ route('admin.projects.destroy', $project) }}" 
                                        class="text-red-600 hover:text-red-900 font-medium">Delete</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Belum ada project. <a href="{{ route('admin.projects.create') }}" class="text-indigo-600 hover:underline">Tambah project baru</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $projects->links() }}
</div>
@endsection


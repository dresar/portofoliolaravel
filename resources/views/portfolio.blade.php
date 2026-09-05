@extends('components.layouts.app', ['title' => 'Portfolio'])

@section('content')
<div class="min-h-screen py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold text-center mb-4 text-gray-900 dark:text-white">
            Portfolio
        </h1>
        <p class="text-xl text-center text-gray-600 dark:text-gray-400 mb-12">
            Koleksi proyek yang telah saya kerjakan
        </p>
        
        <!-- Filter Categories -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <a href="/portfolio?category=all" 
               class="px-6 py-2 rounded-lg font-semibold transition {{ $selectedCategory === 'all' ? 'bg-indigo-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600' }}">
                All
            </a>
            @foreach($categories as $category)
                <a href="/portfolio?category={{ $category }}" 
                   class="px-6 py-2 rounded-lg font-semibold transition {{ $selectedCategory === $category ? 'bg-indigo-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600' }}">
                    {{ $category }}
                </a>
            @endforeach
        </div>
        
        <!-- Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($projects as $project)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                    @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-indigo-400 to-purple-500"></div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-indigo-600 dark:text-indigo-400 font-semibold">{{ $project->category }}</span>
                            @if($project->is_featured)
                                <span class="text-xs bg-yellow-400 text-yellow-900 px-2 py-1 rounded">Featured</span>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">{{ $project->title }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">{{ \Illuminate\Support\Str::limit($project->description, 120) }}</p>
                        @if($project->url)
                            <a href="{{ $project->url }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:underline font-semibold inline-flex items-center">
                                View Project 
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 dark:text-gray-400 py-12">
                    <p class="text-lg">Belum ada project yang ditampilkan. Silakan tambahkan project melalui admin panel.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection


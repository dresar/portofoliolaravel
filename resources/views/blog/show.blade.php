@extends('components.layouts.app', ['title' => $post->title])

@section('content')
<div class="min-h-screen py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <article class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 md:p-12">
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-64 md:h-96 object-cover rounded-lg mb-8">
            @endif
            
            <time class="text-sm text-gray-500 dark:text-gray-400">
                {{ $post->published_at->format('d M Y') }}
            </time>
            
            <h1 class="text-4xl md:text-5xl font-bold mt-4 mb-6 text-gray-900 dark:text-white">
                {{ $post->title }}
            </h1>
            
            @if($post->excerpt)
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">{{ $post->excerpt }}</p>
            @endif
            
            <div class="prose prose-lg dark:prose-invert max-w-none">
                {!! $post->content !!}
            </div>
            
            <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                <a href="/blog" class="text-indigo-600 dark:text-indigo-400 hover:underline font-semibold inline-flex items-center">
                    ← Back to Blog
                </a>
            </div>
        </article>
    </div>
</div>
@endsection


@extends('admin.layouts.app')

@section('title', isset($post) ? 'Edit Post' : 'Buat Post')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">
        {{ isset($post) ? 'Edit Post' : 'Buat Post' }}
    </h1>

    <form action="{{ isset($post) ? route('admin.posts.update', $post) : route('admin.posts.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="ajax-form bg-white rounded-lg shadow p-6 space-y-6">
        @csrf
        @if(isset($post))
            @method('PUT')
        @endif

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   value="{{ old('title', $post->title ?? '') }}" 
                   required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
        </div>

        <div>
            <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug *</label>
            <input type="text" 
                   id="slug" 
                   name="slug" 
                   value="{{ old('slug', $post->slug ?? '') }}" 
                   required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
        </div>

        <div>
            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
            <textarea id="excerpt" 
                      name="excerpt" 
                      rows="2"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
        </div>

        <div>
            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
            <textarea id="content" 
                      name="content" 
                      rows="10" 
                      required
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('content', $post->content ?? '') }}</textarea>
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
            @if(isset($post) && $post->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Current image" class="w-32 h-32 object-cover rounded">
                </div>
            @endif
            <input type="file" 
                   id="image" 
                   name="image" 
                   accept="image/*"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="flex items-center">
                <input type="checkbox" 
                       id="is_published" 
                       name="is_published" 
                       value="1"
                       {{ old('is_published', $post->is_published ?? false) ? 'checked' : '' }}
                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="is_published" class="ml-2 block text-sm text-gray-700">
                    Published
                </label>
            </div>

            <div>
                <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">Published At</label>
                <input type="datetime-local" 
                       id="published_at" 
                       name="published_at" 
                       value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.posts.index') }}" 
               class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                {{ isset($post) ? 'Update' : 'Create' }}
            </button>
        </div>
    </form>
</div>
@endsection


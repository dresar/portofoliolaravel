<div class="min-h-screen py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold text-center mb-4 text-gray-900 dark:text-white">
            Blog
        </h1>
        <p class="text-xl text-center text-gray-600 dark:text-gray-400 mb-12">
            Artikel dan catatan terbaru
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse(\App\Models\Post::published()->orderBy('published_at', 'desc')->get() as $post)
                <article class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-indigo-400 to-purple-500"></div>
                    @endif
                    <div class="p-6">
                        <time class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $post->published_at->format('d M Y') }}
                        </time>
                        <h2 class="text-xl font-bold mt-2 mb-3 text-gray-900 dark:text-white">
                            <a href="/blog/{{ $post->slug }}" wire:navigate class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                                {{ $post->title }}
                            </a>
                        </h2>
                        @if($post->excerpt)
                            <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $post->excerpt }}</p>
                        @else
                            <p class="text-gray-600 dark:text-gray-300 mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}</p>
                        @endif
                        <a href="/blog/{{ $post->slug }}" wire:navigate class="text-indigo-600 dark:text-indigo-400 hover:underline font-semibold inline-flex items-center">
                            Read More 
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center text-gray-500 dark:text-gray-400 py-12">
                    <p class="text-lg">Belum ada artikel yang dipublikasikan. Silakan tambahkan artikel melalui admin panel.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>


<div class="min-h-screen">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">
                        Hi, I'm <span class="text-yellow-300">Your Name</span>
                    </h1>
                    <p class="text-xl md:text-2xl mb-8 text-gray-100">
                        Full Stack Developer & Creative Problem Solver
                    </p>
                    <p class="text-lg mb-8 text-gray-200">
                        Saya adalah seorang developer yang passionate dalam membuat aplikasi web modern dan mobile responsive. 
                        Spesialisasi dalam Laravel, Livewire, dan teknologi web terdepan.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="/portfolio" wire:navigate class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                            View Portfolio
                        </a>
                        <a href="/contact" wire:navigate class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-indigo-600 transition">
                            Get In Touch
                        </a>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="w-64 h-64 md:w-80 md:h-80 rounded-full bg-white/20 backdrop-blur-lg flex items-center justify-center">
                        <img src="https://via.placeholder.com/300" alt="Profile" class="w-60 h-60 md:w-72 md:h-72 rounded-full object-cover border-4 border-white">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-900 dark:text-white">
                Featured Projects
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse(\App\Models\Project::where('is_featured', true)->orderBy('order')->limit(3)->get() as $project)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-indigo-400 to-purple-500"></div>
                        @endif
                        <div class="p-6">
                            <span class="text-sm text-indigo-600 dark:text-indigo-400 font-semibold">{{ $project->category }}</span>
                            <h3 class="text-xl font-bold mt-2 mb-2 text-gray-900 dark:text-white">{{ $project->title }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">{{ \Illuminate\Support\Str::limit($project->description, 100) }}</p>
                            @if($project->url)
                                <a href="{{ $project->url }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:underline font-semibold">
                                    View Project →
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 dark:text-gray-400">
                        <p>Belum ada project yang ditampilkan. Silakan tambahkan project melalui admin panel.</p>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-12">
                <a href="/portfolio" wire:navigate class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition inline-block">
                    View All Projects
                </a>
            </div>
        </div>
    </section>
</div>


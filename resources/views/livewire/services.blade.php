<div class="min-h-screen py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold text-center mb-4 text-gray-900 dark:text-white">
            Services
        </h1>
        <p class="text-xl text-center text-gray-600 dark:text-gray-400 mb-12">
            Layanan yang saya tawarkan untuk membantu mewujudkan ide Anda
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse(\App\Models\Service::orderBy('order')->get() as $service)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 hover:shadow-xl transition">
                    @if($service->icon)
                        <div class="text-5xl mb-4 text-indigo-600 dark:text-indigo-400">
                            <i class="{{ $service->icon }}"></i>
                        </div>
                    @else
                        <div class="w-16 h-16 bg-indigo-100 dark:bg-indigo-900 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    @endif
                    <h3 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">{{ $service->title }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ $service->description }}</p>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 dark:text-gray-400">
                    <p>Belum ada layanan yang ditampilkan. Silakan tambahkan layanan melalui admin panel.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>


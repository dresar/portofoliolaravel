<div class="min-h-screen py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold text-center mb-4 text-gray-900 dark:text-white">
            Experience
        </h1>
        <p class="text-xl text-center text-gray-600 dark:text-gray-400 mb-12">
            Perjalanan karir dan pengalaman kerja saya
        </p>
        
        <div class="relative">
            <!-- Timeline Line -->
            <div class="absolute left-8 md:left-1/2 top-0 bottom-0 w-0.5 bg-indigo-200 dark:bg-indigo-800 transform md:-translate-x-1/2"></div>
            
            @forelse(\App\Models\Experience::orderBy('start_date', 'desc')->get() as $index => $experience)
                <div class="relative mb-12">
                    <div class="flex flex-col md:flex-row items-start">
                        <!-- Timeline Dot -->
                        <div class="absolute left-6 md:left-1/2 w-4 h-4 bg-indigo-600 rounded-full transform md:-translate-x-1/2 z-10"></div>
                        
                        <!-- Content -->
                        <div class="ml-16 md:ml-0 md:w-1/2 {{ $index % 2 === 0 ? 'md:mr-auto md:pr-12' : 'md:ml-auto md:pl-12 md:text-right' }}">
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $experience->role }}</h3>
                                    @if($experience->is_current)
                                        <span class="text-xs bg-green-400 text-green-900 px-2 py-1 rounded">Current</span>
                                    @endif
                                </div>
                                <h4 class="text-lg font-semibold text-indigo-600 dark:text-indigo-400 mb-2">{{ $experience->company }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                    {{ $experience->start_date->format('M Y') }} - 
                                    @if($experience->is_current)
                                        Present
                                    @else
                                        {{ $experience->end_date->format('M Y') }}
                                    @endif
                                    @if($experience->location)
                                        • {{ $experience->location }}
                                    @endif
                                </p>
                                @if($experience->description)
                                    <p class="text-gray-700 dark:text-gray-300 mt-4">{{ $experience->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 dark:text-gray-400 py-12">
                    <p class="text-lg">Belum ada pengalaman yang ditampilkan. Silakan tambahkan pengalaman melalui admin panel.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>


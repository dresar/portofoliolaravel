<div class="min-h-screen py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold text-center mb-4 text-gray-900 dark:text-white">
            Skills
        </h1>
        <p class="text-xl text-center text-gray-600 dark:text-gray-400 mb-12">
            Teknologi dan keahlian yang saya kuasai
        </p>
        
        @php
            $skillsByCategory = \App\Models\Skill::orderBy('order')->get()->groupBy('category');
        @endphp
        
        @forelse($skillsByCategory as $category => $skills)
            <div class="mb-12">
                @if($category)
                    <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">{{ $category }}</h2>
                @endif
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($skills as $skill)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-3">
                                    @if($skill->icon)
                                        <span class="text-2xl">{{ $skill->icon }}</span>
                                    @endif
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $skill->name }}</h3>
                                </div>
                                <span class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">{{ $skill->proficiency_level }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-3 rounded-full transition-all duration-500" 
                                     style="width: {{ $skill->proficiency_level }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 dark:text-gray-400 py-12">
                <p class="text-lg">Belum ada skill yang ditampilkan. Silakan tambahkan skill melalui admin panel.</p>
            </div>
        @endforelse
    </div>
</div>


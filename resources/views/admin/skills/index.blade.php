@extends('admin.layouts.app')

@section('title', 'Skills')

@section('content')
<div class="space-y-6" x-data="{ showForm: false, editing: null }">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Skills</h1>
        <button @click="showForm = true; editing = null" 
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
            + Tambah Skill
        </button>
    </div>

    <!-- Form Modal -->
    <div x-show="showForm" 
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
         @click.away="showForm = false">
        <div class="bg-white rounded-lg shadow-xl p-6 max-w-md w-full mx-4" @click.stop>
            <h2 class="text-xl font-bold mb-4" x-text="editing ? 'Edit Skill' : 'Tambah Skill'"></h2>
            <form :action="editing ? '/admin/skills/' + editing.id : '/admin/skills'" 
                  method="POST"
                  class="ajax-form space-y-4">
                @csrf
                <template x-if="editing">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                    <input type="text" name="name" :value="editing ? editing.name : ''" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Proficiency Level (0-100) *</label>
                    <input type="number" name="proficiency_level" min="0" max="100" 
                           :value="editing ? editing.proficiency_level : 50" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <input type="text" name="category" :value="editing ? editing.category : ''"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                    <input type="number" name="order" :value="editing ? editing.order : 0"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                
                <div class="flex justify-end space-x-4">
                    <button type="button" @click="showForm = false" 
                            class="px-4 py-2 border border-gray-300 rounded-lg">Cancel</button>
                    <button type="submit" 
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Level</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($skills as $skill)
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $skill->name }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-32 bg-gray-200 rounded-full h-2 mr-2">
                                    <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $skill->proficiency_level }}%"></div>
                                </div>
                                <span class="text-sm text-gray-600">{{ $skill->proficiency_level }}%</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $skill->category ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm font-medium space-x-2">
                            <button @click="showForm = true; editing = {{ json_encode($skill) }}" 
                                    class="text-indigo-600 hover:text-indigo-900">Edit</button>
                            <button data-delete="{{ route('admin.skills.destroy', $skill) }}" 
                                    class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada skill</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection


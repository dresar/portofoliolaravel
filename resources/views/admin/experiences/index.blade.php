@extends('admin.layouts.app')

@section('title', 'Experiences')

@section('content')
<div class="space-y-6" x-data="{ showForm: false, editing: null }">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Experiences</h1>
        <button @click="showForm = true; editing = null" 
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
            + Tambah Experience
        </button>
    </div>

    <!-- Form Modal -->
    <div x-show="showForm" 
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
         @click.away="showForm = false">
        <div class="bg-white rounded-lg shadow-xl p-6 max-w-2xl w-full mx-4" @click.stop>
            <h2 class="text-xl font-bold mb-4" x-text="editing ? 'Edit Experience' : 'Tambah Experience'"></h2>
            <form :action="editing ? '/admin/experiences/' + editing.id : '/admin/experiences'" 
                  method="POST"
                  class="ajax-form space-y-4">
                @csrf
                <template x-if="editing">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Company *</label>
                        <input type="text" name="company" :value="editing ? editing.company : ''" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role *</label>
                        <input type="text" name="role" :value="editing ? editing.role : ''" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Start Date *</label>
                        <input type="date" name="start_date" :value="editing ? editing.start_date : ''" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                        <input type="date" name="end_date" :value="editing ? editing.end_date : ''"
                               :disabled="editing && editing.is_current"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>
                
                <div class="flex items-center">
                    <input type="checkbox" id="is_current" name="is_current" value="1"
                           :checked="editing && editing.is_current"
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="is_current" class="ml-2 block text-sm text-gray-700">
                        Current Position
                    </label>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                              x-text="editing ? editing.description : ''"></textarea>
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Company</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Period</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($experiences as $experience)
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $experience->company }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $experience->role }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $experience->start_date->format('M Y') }} - 
                            {{ $experience->is_current ? 'Present' : $experience->end_date->format('M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($experience->is_current)
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Current</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm font-medium space-x-2">
                            <button @click="showForm = true; editing = {{ json_encode($experience) }}" 
                                    class="text-indigo-600 hover:text-indigo-900">Edit</button>
                            <button data-delete="{{ route('admin.experiences.destroy', $experience) }}" 
                                    class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada experience</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection


@extends('admin.layouts.app')

@section('title', 'Services')

@section('content')
<div class="space-y-6" x-data="{ showForm: false, editing: null }">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Services</h1>
        <button @click="showForm = true; editing = null" 
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
            + Tambah Service
        </button>
    </div>

    <!-- Form Modal -->
    <div x-show="showForm" 
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
         @click.away="showForm = false">
        <div class="bg-white rounded-lg shadow-xl p-6 max-w-md w-full mx-4" @click.stop>
            <h2 class="text-xl font-bold mb-4" x-text="editing ? 'Edit Service' : 'Tambah Service'"></h2>
            <form :action="editing ? '/admin/services/' + editing.id : '/admin/services'" 
                  method="POST"
                  class="ajax-form space-y-4">
                @csrf
                <template x-if="editing">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                <input type="hidden" name="id" :value="editing ? editing.id : ''">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" name="title" :value="editing ? editing.title : ''" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
                    <input type="text" name="icon" :value="editing ? editing.icon : ''"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                    <textarea name="description" rows="3" required
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                              x-text="editing ? editing.description : ''"></textarea>
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Icon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($services as $service)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $service->title }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($service->description, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $service->icon ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $service->order }}</td>
                        <td class="px-6 py-4 text-sm font-medium space-x-2">
                            <button @click="showForm = true; editing = {{ json_encode($service) }}" 
                                    class="text-indigo-600 hover:text-indigo-900">Edit</button>
                            <button data-delete="{{ route('admin.services.destroy', $service) }}" 
                                    class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada service</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection


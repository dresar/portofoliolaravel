@extends('admin.layouts.app')

@section('title', 'Messages')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold text-gray-900">Messages</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($messages as $message)
                    <tr class="{{ !$message->is_read ? 'bg-blue-50' : '' }}">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $message->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $message->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $message->subject ?? '-' }}</td>
                        <td class="px-6 py-4">
                            @if($message->is_read)
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Read</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Unread</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $message->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm font-medium space-x-2">
                            <button onclick="showMessage({{ json_encode($message) }})" 
                                    class="text-indigo-600 hover:text-indigo-900">View</button>
                            @if(!$message->is_read)
                                <button data-read="{{ route('admin.messages.read', $message) }}" 
                                        class="text-green-600 hover:text-green-900">Mark Read</button>
                            @endif
                            <button data-delete="{{ route('admin.messages.destroy', $message) }}" 
                                    class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada pesan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $messages->links() }}
</div>

<!-- Message Modal -->
<div id="messageModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-xl p-6 max-w-2xl w-full mx-4">
        <h2 class="text-xl font-bold mb-4" id="messageName"></h2>
        <div class="space-y-2 mb-4">
            <p class="text-sm text-gray-600"><strong>Email:</strong> <span id="messageEmail"></span></p>
            <p class="text-sm text-gray-600"><strong>Subject:</strong> <span id="messageSubject"></span></p>
            <p class="text-sm text-gray-600"><strong>Date:</strong> <span id="messageDate"></span></p>
        </div>
        <div class="border-t pt-4">
            <p class="text-gray-700" id="messageContent"></p>
        </div>
        <div class="mt-6 flex justify-end">
            <button onclick="document.getElementById('messageModal').classList.add('hidden')" 
                    class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                Close
            </button>
        </div>
    </div>
</div>

<script>
function showMessage(message) {
    document.getElementById('messageName').textContent = message.name;
    document.getElementById('messageEmail').textContent = message.email;
    document.getElementById('messageSubject').textContent = message.subject || '-';
    document.getElementById('messageDate').textContent = new Date(message.created_at).toLocaleString('id-ID');
    document.getElementById('messageContent').textContent = message.message;
    document.getElementById('messageModal').classList.remove('hidden');
}

// Handle mark as read
document.addEventListener('click', function(e) {
    if (e.target.closest('[data-read]')) {
        const button = e.target.closest('[data-read]');
        const url = button.getAttribute('data-read');
        
        fetch(url, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        });
    }
});
</script>
@endsection


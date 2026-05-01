<x-admin::layouts>
    <x-slot:title>@lang('marketplace::app.admin.flags.title')</x-slot>

    <div class="flex gap-4 justify-between items-center max-sm:flex-wrap mb-6">
        <p class="text-xl text-gray-800 dark:text-white font-bold">
            @lang('marketplace::app.admin.flags.title')
        </p>
        <button onclick="document.getElementById('create-modal').classList.remove('hidden')" class="primary-button">
            Add Flag Reason
        </button>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded box-shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">ID</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Title</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Type</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Status</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($flagReasons as $reason)
                    <tr class="border-t dark:border-gray-700">
                        <td class="px-4 py-3 text-gray-800 dark:text-white">{{ $reason->id }}</td>
                        <td class="px-4 py-3 text-gray-800 dark:text-white">{{ $reason->title }}</td>
                        <td class="px-4 py-3"><span class="badge label-info">{{ ucfirst($reason->type) }}</span></td>
                        <td class="px-4 py-3"><span class="badge {{ $reason->is_active ? 'label-active' : 'label-canceled' }}">{{ $reason->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td class="px-4 py-3">
                            <button onclick="deleteReason({{ $reason->id }})" class="text-red-500 hover:text-red-700">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Create Modal --}}
    <div id="create-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-900 rounded-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Add Flag Reason</h3>
            <form id="create-form">
                @csrf
                <div class="space-y-3">
                    <input type="text" name="title" placeholder="Title" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white" required>
                    <select name="type" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white">
                        <option value="product">Product</option>
                        <option value="seller">Seller</option>
                    </select>
                    <div class="flex gap-2 justify-end">
                        <button type="button" onclick="document.getElementById('create-modal').classList.add('hidden')" class="secondary-button">Cancel</button>
                        <button type="submit" class="primary-button">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('create-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const data = new FormData(this);
            fetch('{{ route('admin.marketplace.flag-reasons.store') }}', {
                method: 'POST',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json'},
                body: JSON.stringify(Object.fromEntries(data)),
            }).then(r => r.json()).then(() => location.reload());
        });

        function deleteReason(id) {
            if (!confirm('Delete this flag reason?')) return;
            fetch(`/{{ config('app.admin_url') }}/marketplace/flag-reasons/${id}`, {
                method: 'DELETE',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            }).then(() => location.reload());
        }
    </script>
</x-admin::layouts>

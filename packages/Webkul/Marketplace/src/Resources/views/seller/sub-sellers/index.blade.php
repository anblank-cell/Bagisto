@component('marketplace::layouts.seller')
    @slot('title')Sub-Sellers@endslot

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-800 dark:text-white">Sub-Sellers</h1>
        <button onclick="document.getElementById('create-modal').classList.remove('hidden')" class="primary-button">
            + Add Sub-Seller
        </button>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Name</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Email</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Status</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subSellers as $sub)
                    <tr class="border-t dark:border-gray-700">
                        <td class="px-4 py-3 text-gray-800 dark:text-white">{{ $sub->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $sub->email }}</td>
                        <td class="px-4 py-3">
                            <span class="badge {{ $sub->is_active ? 'label-active' : 'label-canceled' }}">
                                {{ $sub->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <button onclick="deleteSub({{ $sub->id }})" class="text-red-500 hover:underline text-sm">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-8 text-center text-gray-500">No sub-sellers yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Create Modal --}}
    <div id="create-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-900 rounded-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Add Sub-Seller</h3>
            <form method="POST" action="{{ route('marketplace.seller.sub-sellers.store') }}" class="space-y-3">
                @csrf
                <input type="text" name="name" placeholder="Full Name" required
                       class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white">
                <input type="email" name="email" placeholder="Email" required
                       class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white">
                <input type="password" name="password" placeholder="Password" required
                       class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required
                       class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white">
                <div class="flex gap-2 justify-end">
                    <button type="button" onclick="document.getElementById('create-modal').classList.add('hidden')"
                            class="secondary-button">Cancel</button>
                    <button type="submit" class="primary-button">Create</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function deleteSub(id) {
            if (!confirm('Delete this sub-seller?')) return;
            fetch(`/marketplace/seller/sub-sellers/${id}`, {
                method: 'DELETE',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            }).then(() => location.reload());
        }
    </script>
@endcomponent

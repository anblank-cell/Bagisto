@component('marketplace::layouts.seller')
    @slot('title')My Products@endslot

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-800 dark:text-white">My Products</h1>
        <div class="flex gap-2">
            <a href="{{ route('marketplace.seller.products.assign') }}" class="secondary-button">Assign Existing</a>
            <a href="{{ route('marketplace.seller.products.create') }}" class="primary-button">+ New Product</a>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">SKU</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Type</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Status</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $sp)
                    <tr class="border-t dark:border-gray-700">
                        <td class="px-4 py-3 text-gray-800 dark:text-white">{{ $sp->product?->sku }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $sp->is_owner ? 'Own' : 'Assigned' }}</td>
                        <td class="px-4 py-3">
                            <span class="badge {{ $sp->is_approved ? 'label-active' : 'label-pending' }}">
                                {{ $sp->is_approved ? 'Approved' : 'Pending' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 flex gap-2">
                            <a href="{{ route('marketplace.seller.products.edit', $sp->product_id) }}" class="text-blue-500 hover:underline">Edit</a>
                            <button onclick="deleteProduct({{ $sp->product_id }})" class="text-red-500 hover:underline">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-8 text-center text-gray-500">No products yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        function deleteProduct(id) {
            if (!confirm('Delete this product?')) return;
            fetch(`/marketplace/seller/products/${id}`, {
                method: 'DELETE',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            }).then(() => location.reload());
        }
    </script>
@endcomponent

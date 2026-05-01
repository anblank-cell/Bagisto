@component('marketplace::layouts.seller')
    @slot('title')My Orders@endslot

    <h1 class="text-xl font-bold text-gray-800 dark:text-white mb-6">My Orders</h1>

    <div class="bg-white dark:bg-gray-900 rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Order #</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Total</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Your Earnings</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Status</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Payout</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $sellerOrder)
                    <tr class="border-t dark:border-gray-700">
                        <td class="px-4 py-3 text-gray-800 dark:text-white">#{{ $sellerOrder->order?->increment_id }}</td>
                        <td class="px-4 py-3">{{ core()->formatPrice($sellerOrder->grand_total) }}</td>
                        <td class="px-4 py-3 text-green-600 font-semibold">{{ core()->formatPrice($sellerOrder->seller_total) }}</td>
                        <td class="px-4 py-3"><span class="badge label-info">{{ ucfirst($sellerOrder->status) }}</span></td>
                        <td class="px-4 py-3">
                            <span class="badge {{ $sellerOrder->is_paid ? 'label-active' : 'label-pending' }}">
                                {{ $sellerOrder->is_paid ? 'Paid' : 'Pending' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('marketplace.seller.orders.show', $sellerOrder->id) }}" class="text-blue-500 hover:underline">View</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">No orders yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endcomponent

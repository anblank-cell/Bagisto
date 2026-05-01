@component('marketplace::layouts.seller')
    @slot('title')My Transactions@endslot

    <h1 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Transactions</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white dark:bg-gray-900 rounded-lg p-4 text-center shadow">
            <p class="text-gray-500 text-sm">Total Revenue</p>
            <p class="text-2xl font-bold text-green-600">{{ core()->formatPrice($seller->total_revenue) }}</p>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-lg p-4 text-center shadow">
            <p class="text-gray-500 text-sm">Total Payout</p>
            <p class="text-2xl font-bold text-blue-600">{{ core()->formatPrice($seller->total_payout) }}</p>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-lg p-4 text-center shadow">
            <p class="text-gray-500 text-sm">Remaining</p>
            <p class="text-2xl font-bold text-orange-500">{{ core()->formatPrice($seller->remaining_payout) }}</p>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">ID</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Amount</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Type</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Status</th>
                    <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $tx)
                    <tr class="border-t dark:border-gray-700">
                        <td class="px-4 py-3 text-gray-800 dark:text-white">{{ $tx->id }}</td>
                        <td class="px-4 py-3 font-semibold text-green-600">{{ core()->formatPrice($tx->amount) }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ ucfirst($tx->type) }}</td>
                        <td class="px-4 py-3"><span class="badge {{ $tx->status === 'completed' ? 'label-active' : 'label-pending' }}">{{ ucfirst($tx->status) }}</span></td>
                        <td class="px-4 py-3 text-gray-500">{{ $tx->created_at->format('M d, Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">No transactions yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endcomponent

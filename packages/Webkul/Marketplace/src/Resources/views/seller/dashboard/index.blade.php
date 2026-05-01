@component('marketplace::layouts.seller')
    @slot('title')Seller Dashboard — {{ $seller->shop_title }}@endslot

    {{-- Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        <div class="bg-white dark:bg-gray-900 rounded-lg p-4 text-center shadow">
            <p class="text-gray-500 text-sm">Products</p>
            <p class="text-2xl font-bold text-navyBlue">{{ $stats['total_products'] }}</p>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-lg p-4 text-center shadow">
            <p class="text-gray-500 text-sm">Orders</p>
            <p class="text-2xl font-bold text-navyBlue">{{ $stats['total_orders'] }}</p>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-lg p-4 text-center shadow">
            <p class="text-gray-500 text-sm">Total Revenue</p>
            <p class="text-2xl font-bold text-green-600">{{ core()->formatPrice($stats['total_revenue']) }}</p>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-lg p-4 text-center shadow">
            <p class="text-gray-500 text-sm">Total Payout</p>
            <p class="text-2xl font-bold text-blue-600">{{ core()->formatPrice($stats['total_payout']) }}</p>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-lg p-4 text-center shadow">
            <p class="text-gray-500 text-sm">Remaining</p>
            <p class="text-2xl font-bold text-orange-500">{{ core()->formatPrice($stats['remaining_payout']) }}</p>
        </div>
    </div>

    {{-- Recent Orders --}}
    <div class="bg-white dark:bg-gray-900 rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white">Recent Orders</h2>
            <a href="{{ route('marketplace.seller.orders.index') }}" class="text-sm text-navyBlue hover:underline">View All</a>
        </div>
        @forelse($recentOrders as $sellerOrder)
            <div class="flex justify-between items-center py-3 border-b dark:border-gray-700 last:border-0">
                <div>
                    <p class="font-semibold text-gray-800 dark:text-white">#{{ $sellerOrder->order?->increment_id }}</p>
                    <p class="text-sm text-gray-500">{{ $sellerOrder->created_at->diffForHumans() }}</p>
                </div>
                <div class="text-right">
                    <p class="font-bold text-green-600">{{ core()->formatPrice($sellerOrder->seller_total) }}</p>
                    <span class="badge label-info">{{ ucfirst($sellerOrder->status) }}</span>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center py-8">No orders yet.</p>
        @endforelse
    </div>
@endcomponent

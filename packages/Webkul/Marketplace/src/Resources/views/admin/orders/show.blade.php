<x-admin::layouts>
    <x-slot:title>Order #{{ $sellerOrder->order->increment_id }}</x-slot>

    <div class="flex gap-4 justify-between items-center mb-6">
        <p class="text-xl text-gray-800 dark:text-white font-bold">
            Order #{{ $sellerOrder->order->increment_id }} — {{ $sellerOrder->seller->shop_title }}
        </p>
        @if(! $sellerOrder->is_paid)
            <button onclick="createPayout({{ $sellerOrder->id }})" class="primary-button">
                Create Payout
            </button>
        @else
            <span class="badge label-active">Paid Out</span>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="p-4 bg-white dark:bg-gray-900 rounded box-shadow text-center">
            <p class="text-gray-500 text-sm">Order Total</p>
            <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ core()->formatPrice($sellerOrder->grand_total) }}</p>
        </div>
        <div class="p-4 bg-white dark:bg-gray-900 rounded box-shadow text-center">
            <p class="text-gray-500 text-sm">Commission</p>
            <p class="text-2xl font-bold text-red-500">{{ core()->formatPrice($sellerOrder->commission) }}</p>
        </div>
        <div class="p-4 bg-white dark:bg-gray-900 rounded box-shadow text-center">
            <p class="text-gray-500 text-sm">Seller Earns</p>
            <p class="text-2xl font-bold text-green-600">{{ core()->formatPrice($sellerOrder->seller_total) }}</p>
        </div>
    </div>

    <script>
        function createPayout(id) {
            if (!confirm('Create payout for this order?')) return;
            fetch(`/{{ config('app.admin_url') }}/marketplace/orders/${id}/payout`, {
                method: 'POST',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json'},
            }).then(r => r.json()).then(d => { alert(d.message); location.reload(); });
        }
    </script>
</x-admin::layouts>

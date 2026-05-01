<x-admin::layouts>
    <x-slot:title>{{ $seller->shop_title }}</x-slot>

    <div class="flex gap-4 justify-between items-center max-sm:flex-wrap mb-6">
        <p class="text-xl text-gray-800 dark:text-white font-bold">{{ $seller->shop_title }}</p>
        <div class="flex gap-2">
            @if(! $seller->is_approved)
                <button onclick="approveSeller({{ $seller->id }})" class="primary-button">
                    @lang('marketplace::app.admin.sellers.datagrid.mass-approve')
                </button>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="p-4 bg-white dark:bg-gray-900 rounded box-shadow">
            <p class="font-semibold text-gray-800 dark:text-white mb-4">Seller Information</p>
            <div class="space-y-2 text-sm">
                <div><span class="text-gray-500">Customer:</span> <span class="text-gray-800 dark:text-white">{{ $seller->customer?->first_name }} {{ $seller->customer?->last_name }}</span></div>
                <div><span class="text-gray-500">Email:</span> <span class="text-gray-800 dark:text-white">{{ $seller->customer?->email }}</span></div>
                <div><span class="text-gray-500">Phone:</span> <span class="text-gray-800 dark:text-white">{{ $seller->phone ?? '-' }}</span></div>
                <div><span class="text-gray-500">Status:</span>
                    <span class="badge {{ $seller->is_approved ? 'label-active' : 'label-pending' }}">
                        {{ $seller->is_approved ? 'Approved' : 'Pending' }}
                    </span>
                </div>
                <div><span class="text-gray-500">Commission:</span> <span class="text-gray-800 dark:text-white">{{ $seller->commission_percentage }}%</span></div>
                <div><span class="text-gray-500">Total Revenue:</span> <span class="text-gray-800 dark:text-white">{{ core()->formatPrice($seller->total_revenue) }}</span></div>
                <div><span class="text-gray-500">Total Payout:</span> <span class="text-gray-800 dark:text-white">{{ core()->formatPrice($seller->total_payout) }}</span></div>
                <div><span class="text-gray-500">Remaining:</span> <span class="text-gray-800 dark:text-white">{{ core()->formatPrice($seller->remaining_payout) }}</span></div>
            </div>
        </div>

        <div class="p-4 bg-white dark:bg-gray-900 rounded box-shadow">
            <p class="font-semibold text-gray-800 dark:text-white mb-4">Edit Settings</p>
            <form action="{{ route('admin.marketplace.sellers.update', $seller->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="space-y-3">
                    <div>
                        <label class="text-sm text-gray-600 dark:text-gray-300">Commission %</label>
                        <input type="number" name="commission_percentage" value="{{ $seller->commission_percentage }}" step="0.01" min="0" max="100" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white">
                    </div>
                    <div>
                        <label class="text-sm text-gray-600 dark:text-gray-300">Minimum Order Price</label>
                        <input type="number" name="minimum_order_price" value="{{ $seller->minimum_order_price }}" step="0.01" min="0" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white">
                    </div>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                            <input type="checkbox" name="allow_invoice" value="1" {{ $seller->allow_invoice ? 'checked' : '' }}> Allow Invoice
                        </label>
                        <label class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                            <input type="checkbox" name="allow_shipment" value="1" {{ $seller->allow_shipment ? 'checked' : '' }}> Allow Shipment
                        </label>
                    </div>
                    <input type="hidden" name="shop_title" value="{{ $seller->shop_title }}">
                    <input type="hidden" name="is_active" value="{{ $seller->is_active ? 1 : 0 }}">
                    <button type="submit" class="primary-button">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</x-admin::layouts>

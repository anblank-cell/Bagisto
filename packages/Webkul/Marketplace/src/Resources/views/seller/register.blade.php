<x-shop::layouts>
    <x-slot:title>Become a Seller</x-slot>

    <div class="container mx-auto px-4 py-12 max-w-lg">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2 text-center">Become a Seller</h1>
        <p class="text-gray-500 text-center mb-8">Join our marketplace and start selling today.</p>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 rounded p-4 mb-4">{{ session('success') }}</div>
        @endif

        @if(! auth()->guard('customer')->check())
            <div class="bg-yellow-100 text-yellow-800 rounded p-4 mb-4">
                Please <a href="{{ route('shop.customer.session.index') }}" class="underline font-semibold">login</a> first to register as a seller.
            </div>
        @else
            <form action="{{ route('marketplace.seller.register.store') }}" method="POST" class="bg-white dark:bg-gray-900 rounded-lg shadow p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Shop Name *</label>
                    <input type="text" name="shop_title" value="{{ old('shop_title') }}" required class="w-full border rounded-lg px-4 py-2 dark:bg-gray-800 dark:text-white">
                    @error('shop_title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Shop URL Slug *</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" required placeholder="my-shop" class="w-full border rounded-lg px-4 py-2 dark:bg-gray-800 dark:text-white">
                    @error('slug')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border rounded-lg px-4 py-2 dark:bg-gray-800 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                    <textarea name="description" rows="3" class="w-full border rounded-lg px-4 py-2 dark:bg-gray-800 dark:text-white">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="primary-button w-full justify-center">Submit Application</button>
            </form>
        @endif
    </div>
</x-shop::layouts>

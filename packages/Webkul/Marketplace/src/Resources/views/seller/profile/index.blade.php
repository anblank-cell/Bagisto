@component('marketplace::layouts.seller')
    @slot('title')My Profile@endslot

    <h1 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Shop Profile</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 rounded p-4 mb-4">{{ session('success') }}</div>
    @endif

    <form action="{{ route('marketplace.seller.profile.update') }}" method="POST" enctype="multipart/form-data"
          class="bg-white dark:bg-gray-900 rounded-lg shadow p-6 space-y-4">
        @csrf @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Shop Name *</label>
                <input type="text" name="shop_title" value="{{ $seller->shop_title }}" required
                       class="w-full border rounded-lg px-4 py-2 dark:bg-gray-800 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Shop URL Slug *</label>
                <input type="text" name="slug" value="{{ $seller->slug }}" required
                       class="w-full border rounded-lg px-4 py-2 dark:bg-gray-800 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone</label>
                <input type="text" name="phone" value="{{ $seller->phone }}"
                       class="w-full border rounded-lg px-4 py-2 dark:bg-gray-800 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                <input type="text" name="city" value="{{ $seller->city }}"
                       class="w-full border rounded-lg px-4 py-2 dark:bg-gray-800 dark:text-white">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
            <textarea name="description" rows="3" class="w-full border rounded-lg px-4 py-2 dark:bg-gray-800 dark:text-white">{{ $seller->description }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Return Policy</label>
            <textarea name="return_policy" rows="3" class="w-full border rounded-lg px-4 py-2 dark:bg-gray-800 dark:text-white">{{ $seller->return_policy }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Shipping Policy</label>
            <textarea name="shipping_policy" rows="3" class="w-full border rounded-lg px-4 py-2 dark:bg-gray-800 dark:text-white">{{ $seller->shipping_policy }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Logo</label>
                @if($seller->logo_url)<img src="{{ $seller->logo_url }}" class="h-16 mb-2 rounded">@endif
                <input type="file" name="logo" accept="image/*" class="w-full text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Banner</label>
                @if($seller->banner_url)<img src="{{ $seller->banner_url }}" class="h-16 mb-2 rounded">@endif
                <input type="file" name="banner" accept="image/*" class="w-full text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach(['facebook_url' => 'Facebook', 'twitter_url' => 'Twitter', 'instagram_url' => 'Instagram', 'youtube_url' => 'YouTube'] as $field => $label)
                <div>
                    <label class="block text-xs text-gray-500 mb-1">{{ $label }}</label>
                    <input type="url" name="{{ $field }}" value="{{ $seller->$field }}"
                           class="w-full border rounded px-3 py-2 text-sm dark:bg-gray-800 dark:text-white">
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Meta Title</label>
                <input type="text" name="meta_title" value="{{ $seller->meta_title }}"
                       class="w-full border rounded-lg px-4 py-2 dark:bg-gray-800 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Meta Keywords</label>
                <input type="text" name="meta_keywords" value="{{ $seller->meta_keywords }}"
                       class="w-full border rounded-lg px-4 py-2 dark:bg-gray-800 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Meta Description</label>
                <input type="text" name="meta_description" value="{{ $seller->meta_description }}"
                       class="w-full border rounded-lg px-4 py-2 dark:bg-gray-800 dark:text-white">
            </div>
        </div>

        <button type="submit" class="primary-button">Save Profile</button>
    </form>
@endcomponent

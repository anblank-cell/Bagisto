<x-shop::layouts>
    <x-slot:title>Marketplace</x-slot>

    {{-- Hero --}}
    <div class="bg-gradient-to-r from-navyBlue to-blue-700 text-white py-16">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold mb-4">Our Marketplace</h1>
            <p class="text-xl opacity-90 mb-8">Shop from hundreds of trusted sellers</p>
            <a href="{{ route('marketplace.sellers.index') }}" class="bg-white text-navyBlue font-bold py-3 px-8 rounded-lg hover:bg-gray-100 transition">
                Browse All Sellers
            </a>
        </div>
    </div>

    {{-- Top Sellers --}}
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white text-center mb-12">Top Sellers</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($topSellers as $seller)
                <a href="{{ route('marketplace.sellers.show', $seller->slug) }}" class="bg-white dark:bg-gray-900 rounded-xl shadow hover:shadow-lg transition overflow-hidden">
                    @if($seller->banner_url)
                        <img src="{{ $seller->banner_url }}" alt="{{ $seller->shop_title }}" class="w-full h-32 object-cover">
                    @else
                        <div class="w-full h-32 bg-gradient-to-r from-blue-400 to-purple-500"></div>
                    @endif
                    <div class="p-4 flex items-center gap-4">
                        @if($seller->logo_url)
                            <img src="{{ $seller->logo_url }}" alt="{{ $seller->shop_title }}" class="w-14 h-14 rounded-full object-cover border-2 border-white shadow -mt-8">
                        @else
                            <div class="w-14 h-14 rounded-full bg-navyBlue flex items-center justify-center text-white font-bold text-xl -mt-8 border-2 border-white shadow">
                                {{ strtoupper(substr($seller->shop_title, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <h3 class="font-bold text-gray-800 dark:text-white">{{ $seller->shop_title }}</h3>
                            <p class="text-sm text-gray-500">{{ $seller->products->count() }} products</p>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-3 text-center text-gray-500 py-12">No sellers yet. <a href="{{ route('marketplace.seller.register') }}" class="text-navyBlue underline">Become a seller!</a></div>
            @endforelse
        </div>
    </div>

    {{-- Become a Seller CTA --}}
    <div class="bg-gray-50 dark:bg-gray-800 py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Want to sell here?</h2>
            <p class="text-gray-500 mb-8">Join our marketplace and reach thousands of customers.</p>
            <a href="{{ route('marketplace.seller.register') }}" class="primary-button mx-auto">Start Selling</a>
        </div>
    </div>
</x-shop::layouts>

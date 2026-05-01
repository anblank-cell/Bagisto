<x-shop::layouts>
    <x-slot:title>{{ $title ?? 'Seller Dashboard' }}</x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="flex gap-6 max-md:flex-col">

            {{-- Sidebar --}}
            <aside class="w-64 max-md:w-full flex-shrink-0">
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow overflow-hidden">
                    {{-- Seller Info --}}
                    <div class="bg-navyBlue text-white p-4">
                        <p class="font-bold text-lg truncate">{{ auth()->guard('customer')->user()?->first_name }}</p>
                        <p class="text-sm opacity-75 truncate">{{ auth()->guard('customer')->user()?->email }}</p>
                    </div>

                    {{-- Nav Links --}}
                    <nav class="p-2">
                        @php
                            $links = [
                                ['route' => 'marketplace.seller.dashboard',         'label' => 'Dashboard',     'icon' => '📊'],
                                ['route' => 'marketplace.seller.products.index',    'label' => 'Products',      'icon' => '📦'],
                                ['route' => 'marketplace.seller.orders.index',      'label' => 'Orders',        'icon' => '🛒'],
                                ['route' => 'marketplace.seller.transactions.index','label' => 'Transactions',  'icon' => '💰'],
                                ['route' => 'marketplace.seller.sub-sellers.index', 'label' => 'Sub-Sellers',   'icon' => '👥'],
                                ['route' => 'marketplace.seller.profile',           'label' => 'Profile',       'icon' => '⚙️'],
                            ];
                        @endphp

                        @foreach($links as $link)
                            <a href="{{ route($link['route']) }}"
                               class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition
                                      {{ request()->routeIs($link['route']) ? 'bg-navyBlue text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                                <span>{{ $link['icon'] }}</span>
                                {{ $link['label'] }}
                            </a>
                        @endforeach
                    </nav>
                </div>
            </aside>

            {{-- Main Content --}}
            <main class="flex-1 min-w-0">
                {{ $slot }}
            </main>

        </div>
    </div>
</x-shop::layouts>

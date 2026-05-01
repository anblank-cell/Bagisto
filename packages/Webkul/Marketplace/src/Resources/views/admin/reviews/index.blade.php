<x-admin::layouts>
    <x-slot:title>@lang('marketplace::app.admin.reviews.title')</x-slot>

    <div class="flex gap-4 justify-between items-center max-sm:flex-wrap">
        <p class="text-xl text-gray-800 dark:text-white font-bold">
            @lang('marketplace::app.admin.reviews.title')
        </p>
    </div>

    <x-admin::datagrid :src="route('admin.marketplace.reviews.index')" />
</x-admin::layouts>

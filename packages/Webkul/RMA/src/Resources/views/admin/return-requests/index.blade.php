<x-admin::layouts>

    <!-- Title of the page -->
    <x-slot:title>
       @lang('rma::app.admin.return-requests.title')
    </x-slot>

    <!-- Page Content -->
    <div class="page-content">
         <x-admin::datagrid :src="route('admin.rma.return-requests.index')" />
    </div>

</x-admin::layouts>
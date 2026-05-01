<?php

namespace Webkul\Marketplace\DataGrids\Admin;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class SellerDataGrid extends DataGrid
{
    public function prepareQueryBuilder()
    {
        return DB::table('mp_sellers as s')
            ->join('customers as c', 's.customer_id', '=', 'c.id')
            ->select('s.id', 's.shop_title', 's.slug', 's.commission_percentage', 's.is_approved', 's.is_active', 's.total_revenue', 's.created_at',
                DB::raw("CONCAT(c.first_name, ' ', c.last_name) as customer_name"), 'c.email');
    }

    public function prepareColumns()
    {
        $this->addColumn(['index' => 'id', 'label' => trans('marketplace::app.admin.sellers.datagrid.id'), 'type' => 'integer', 'sortable' => true, 'filterable' => false]);
        $this->addColumn(['index' => 'shop_title', 'label' => trans('marketplace::app.admin.sellers.datagrid.shop-title'), 'type' => 'string', 'searchable' => true, 'sortable' => true]);
        $this->addColumn(['index' => 'customer_name', 'label' => trans('marketplace::app.admin.sellers.datagrid.customer'), 'type' => 'string', 'searchable' => true, 'sortable' => true]);
        $this->addColumn(['index' => 'email', 'label' => trans('marketplace::app.admin.sellers.datagrid.email'), 'type' => 'string', 'searchable' => true, 'sortable' => true]);
        $this->addColumn(['index' => 'commission_percentage', 'label' => trans('marketplace::app.admin.sellers.datagrid.commission'), 'type' => 'string', 'sortable' => true]);
        $this->addColumn([
            'index' => 'is_approved', 'label' => trans('marketplace::app.admin.sellers.datagrid.status'), 'type' => 'string', 'sortable' => true,
            'closure' => fn($row) => $row->is_approved
                ? "<span class='badge label-active'>" . trans('marketplace::app.admin.sellers.datagrid.approved') . "</span>"
                : "<span class='badge label-pending'>" . trans('marketplace::app.admin.sellers.datagrid.pending') . "</span>",
        ]);
        $this->addColumn(['index' => 'total_revenue', 'label' => trans('marketplace::app.admin.sellers.datagrid.revenue'), 'type' => 'string', 'sortable' => true]);
        $this->addColumn(['index' => 'created_at', 'label' => trans('marketplace::app.admin.sellers.datagrid.created-at'), 'type' => 'datetime', 'sortable' => true]);
    }

    public function prepareActions()
    {
        $this->addAction(['icon' => 'icon-view', 'title' => trans('marketplace::app.admin.sellers.datagrid.view'), 'method' => 'GET', 'url' => fn($row) => route('admin.marketplace.sellers.show', $row->id)]);
        $this->addAction(['icon' => 'icon-delete', 'title' => trans('marketplace::app.admin.sellers.datagrid.delete'), 'method' => 'DELETE', 'url' => fn($row) => route('admin.marketplace.sellers.delete', $row->id)]);
    }

    public function prepareMassActions()
    {
        $this->addMassAction(['icon' => 'icon-delete', 'title' => trans('marketplace::app.admin.sellers.datagrid.mass-delete'), 'method' => 'POST', 'url' => route('admin.marketplace.sellers.mass-delete')]);
        $this->addMassAction(['icon' => 'icon-check', 'title' => trans('marketplace::app.admin.sellers.datagrid.mass-approve'), 'method' => 'POST', 'url' => route('admin.marketplace.sellers.mass-approve')]);
    }
}

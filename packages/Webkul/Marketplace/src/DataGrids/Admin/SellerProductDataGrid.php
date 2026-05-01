<?php

namespace Webkul\Marketplace\DataGrids\Admin;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class SellerProductDataGrid extends DataGrid
{
    public function prepareQueryBuilder()
    {
        return DB::table('mp_seller_products as sp')
            ->join('mp_sellers as s', 'sp.seller_id', '=', 's.id')
            ->join('products as p', 'sp.product_id', '=', 'p.id')
            ->select('sp.id', 'sp.is_approved', 'sp.is_owner', 'p.sku', 's.shop_title', 'sp.created_at');
    }

    public function prepareColumns()
    {
        $this->addColumn(['index' => 'id', 'label' => 'ID', 'type' => 'integer', 'sortable' => true]);
        $this->addColumn(['index' => 'sku', 'label' => trans('marketplace::app.admin.products.datagrid.sku'), 'type' => 'string', 'searchable' => true, 'sortable' => true]);
        $this->addColumn(['index' => 'shop_title', 'label' => trans('marketplace::app.admin.products.datagrid.seller'), 'type' => 'string', 'searchable' => true, 'sortable' => true]);
        $this->addColumn([
            'index' => 'is_approved', 'label' => trans('marketplace::app.admin.products.datagrid.status'), 'type' => 'string',
            'closure' => fn($row) => $row->is_approved
                ? "<span class='badge label-active'>" . trans('marketplace::app.admin.products.datagrid.approved') . "</span>"
                : "<span class='badge label-pending'>" . trans('marketplace::app.admin.products.datagrid.pending') . "</span>",
        ]);
        $this->addColumn(['index' => 'created_at', 'label' => trans('marketplace::app.admin.products.datagrid.created-at'), 'type' => 'datetime', 'sortable' => true]);
    }

    public function prepareActions()
    {
        $this->addAction(['icon' => 'icon-check', 'title' => trans('marketplace::app.admin.products.datagrid.approve'), 'method' => 'POST', 'url' => fn($row) => route('admin.marketplace.products.approve', $row->id)]);
        $this->addAction(['icon' => 'icon-delete', 'title' => trans('marketplace::app.admin.products.datagrid.delete'), 'method' => 'DELETE', 'url' => fn($row) => route('admin.marketplace.products.delete', $row->id)]);
    }

    public function prepareMassActions()
    {
        $this->addMassAction(['icon' => 'icon-delete', 'title' => trans('marketplace::app.admin.products.datagrid.mass-delete'), 'method' => 'POST', 'url' => route('admin.marketplace.products.mass-delete')]);
    }
}

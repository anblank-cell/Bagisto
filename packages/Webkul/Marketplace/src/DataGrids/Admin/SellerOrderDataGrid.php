<?php

namespace Webkul\Marketplace\DataGrids\Admin;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class SellerOrderDataGrid extends DataGrid
{
    public function prepareQueryBuilder()
    {
        return DB::table('mp_seller_orders as so')
            ->join('mp_sellers as s', 'so.seller_id', '=', 's.id')
            ->join('orders as o', 'so.order_id', '=', 'o.id')
            ->select('so.id', 'so.grand_total', 'so.commission', 'so.seller_total', 'so.status', 'so.is_paid', 's.shop_title', 'o.increment_id', 'so.created_at');
    }

    public function prepareColumns()
    {
        $this->addColumn(['index' => 'id', 'label' => 'ID', 'type' => 'integer', 'sortable' => true]);
        $this->addColumn(['index' => 'increment_id', 'label' => trans('marketplace::app.admin.orders.datagrid.order-id'), 'type' => 'string', 'searchable' => true, 'sortable' => true]);
        $this->addColumn(['index' => 'shop_title', 'label' => trans('marketplace::app.admin.orders.datagrid.seller'), 'type' => 'string', 'searchable' => true, 'sortable' => true]);
        $this->addColumn(['index' => 'grand_total', 'label' => trans('marketplace::app.admin.orders.datagrid.total'), 'type' => 'string', 'sortable' => true]);
        $this->addColumn(['index' => 'commission', 'label' => trans('marketplace::app.admin.orders.datagrid.commission'), 'type' => 'string', 'sortable' => true]);
        $this->addColumn(['index' => 'seller_total', 'label' => trans('marketplace::app.admin.orders.datagrid.seller-total'), 'type' => 'string', 'sortable' => true]);
        $this->addColumn([
            'index' => 'is_paid', 'label' => trans('marketplace::app.admin.orders.datagrid.payout-status'), 'type' => 'string',
            'closure' => fn($row) => $row->is_paid
                ? "<span class='badge label-active'>" . trans('marketplace::app.admin.orders.datagrid.paid') . "</span>"
                : "<span class='badge label-pending'>" . trans('marketplace::app.admin.orders.datagrid.unpaid') . "</span>",
        ]);
        $this->addColumn(['index' => 'created_at', 'label' => trans('marketplace::app.admin.orders.datagrid.created-at'), 'type' => 'datetime', 'sortable' => true]);
    }

    public function prepareActions()
    {
        $this->addAction(['icon' => 'icon-view', 'title' => trans('marketplace::app.admin.orders.datagrid.view'), 'method' => 'GET', 'url' => fn($row) => route('admin.marketplace.orders.show', $row->id)]);
    }
}

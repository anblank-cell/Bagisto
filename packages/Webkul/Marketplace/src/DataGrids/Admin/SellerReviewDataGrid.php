<?php

namespace Webkul\Marketplace\DataGrids\Admin;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class SellerReviewDataGrid extends DataGrid
{
    public function prepareQueryBuilder()
    {
        return DB::table('mp_seller_reviews as r')
            ->join('mp_sellers as s', 'r.seller_id', '=', 's.id')
            ->select('r.id', 'r.name', 'r.email', 'r.rating', 'r.title', 'r.status', 's.shop_title', 'r.created_at');
    }

    public function prepareColumns()
    {
        $this->addColumn(['index' => 'id', 'label' => 'ID', 'type' => 'integer', 'sortable' => true]);
        $this->addColumn(['index' => 'shop_title', 'label' => trans('marketplace::app.admin.reviews.datagrid.seller'), 'type' => 'string', 'searchable' => true, 'sortable' => true]);
        $this->addColumn(['index' => 'name', 'label' => trans('marketplace::app.admin.reviews.datagrid.reviewer'), 'type' => 'string', 'searchable' => true, 'sortable' => true]);
        $this->addColumn(['index' => 'rating', 'label' => trans('marketplace::app.admin.reviews.datagrid.rating'), 'type' => 'integer', 'sortable' => true]);
        $this->addColumn(['index' => 'title', 'label' => trans('marketplace::app.admin.reviews.datagrid.title'), 'type' => 'string', 'searchable' => true]);
        $this->addColumn([
            'index' => 'status', 'label' => trans('marketplace::app.admin.reviews.datagrid.status'), 'type' => 'string',
            'closure' => fn($row) => match($row->status) {
                'approved' => "<span class='badge label-active'>" . trans('marketplace::app.admin.reviews.datagrid.approved') . "</span>",
                'rejected' => "<span class='badge label-canceled'>" . trans('marketplace::app.admin.reviews.datagrid.rejected') . "</span>",
                default    => "<span class='badge label-pending'>" . trans('marketplace::app.admin.reviews.datagrid.pending') . "</span>",
            },
        ]);
        $this->addColumn(['index' => 'created_at', 'label' => trans('marketplace::app.admin.reviews.datagrid.created-at'), 'type' => 'datetime', 'sortable' => true]);
    }

    public function prepareActions()
    {
        $this->addAction(['icon' => 'icon-check', 'title' => trans('marketplace::app.admin.reviews.datagrid.approve'), 'method' => 'POST', 'url' => fn($row) => route('admin.marketplace.reviews.approve', $row->id)]);
        $this->addAction(['icon' => 'icon-delete', 'title' => trans('marketplace::app.admin.reviews.datagrid.delete'), 'method' => 'DELETE', 'url' => fn($row) => route('admin.marketplace.reviews.delete', $row->id)]);
    }
}

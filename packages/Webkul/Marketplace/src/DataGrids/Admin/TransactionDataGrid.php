<?php

namespace Webkul\Marketplace\DataGrids\Admin;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class TransactionDataGrid extends DataGrid
{
    public function prepareQueryBuilder()
    {
        return DB::table('mp_transactions as t')
            ->join('mp_sellers as s', 't.seller_id', '=', 's.id')
            ->select('t.id', 't.amount', 't.type', 't.status', 't.transaction_id', 's.shop_title', 't.created_at');
    }

    public function prepareColumns()
    {
        $this->addColumn(['index' => 'id', 'label' => 'ID', 'type' => 'integer', 'sortable' => true]);
        $this->addColumn(['index' => 'shop_title', 'label' => trans('marketplace::app.admin.transactions.datagrid.seller'), 'type' => 'string', 'searchable' => true, 'sortable' => true]);
        $this->addColumn(['index' => 'amount', 'label' => trans('marketplace::app.admin.transactions.datagrid.amount'), 'type' => 'string', 'sortable' => true]);
        $this->addColumn(['index' => 'type', 'label' => trans('marketplace::app.admin.transactions.datagrid.type'), 'type' => 'string', 'sortable' => true]);
        $this->addColumn(['index' => 'status', 'label' => trans('marketplace::app.admin.transactions.datagrid.status'), 'type' => 'string', 'sortable' => true]);
        $this->addColumn(['index' => 'transaction_id', 'label' => trans('marketplace::app.admin.transactions.datagrid.transaction-id'), 'type' => 'string', 'searchable' => true]);
        $this->addColumn(['index' => 'created_at', 'label' => trans('marketplace::app.admin.transactions.datagrid.created-at'), 'type' => 'datetime', 'sortable' => true]);
    }

    public function prepareActions() {}
}

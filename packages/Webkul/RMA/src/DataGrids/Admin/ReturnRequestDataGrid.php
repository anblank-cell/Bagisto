<?php

namespace Webkul\RMA\DataGrids\Admin;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class ReturnRequestDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     */
    public function prepareQueryBuilder()
    {
        return DB::table('rma_requests')
            ->select('id', 'customer_id', 'product_sku', 'product_name', 'status', 'created_at');
    }

    /**
     * Prepare columns.
     */
    public function prepareColumns()
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('rma::app.admin.return-requests.datagrid.id'),
            'type'       => 'integer',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => false,
        ]);

        $this->addColumn([
            'index'      => 'product_name',
            'label'      => trans('rma::app.admin.return-requests.datagrid.product-name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => false,
        ]);

        $this->addColumn([
            'index'              => 'product_sku',
            'label'              => trans('rma::app.admin.return-requests.datagrid.product-sku'),
            'type'               => 'string',
            'searchable'         => true,
            'sortable'           => true,
            'filterable'         => false,
        ]);

        $this->addColumn([
            'index'              => 'status',
            'label'              => trans('rma::app.admin.return-requests.datagrid.status'),
            'type'               => 'string',
            'searchable'         => false,
            'sortable'           => true,
            'filterable'         => true,
            'filterable_type'    => 'dropdown',
            'filterable_options' => [
                ['label' => trans('rma::app.admin.return-requests.datagrid.pending'),  'value' => 'pending'],
                ['label' => trans('rma::app.admin.return-requests.datagrid.approved'), 'value' => 'approved'],
                ['label' => trans('rma::app.admin.return-requests.datagrid.rejected'), 'value' => 'rejected'],
            ],
            'closure' => function ($row) {
                $map = [
                    'pending'  => ['label' => trans('rma::app.admin.return-requests.datagrid.pending'),  'class' => 'label-pending'],
                    'approved' => ['label' => trans('rma::app.admin.return-requests.datagrid.approved'), 'class' => 'label-active'],
                    'rejected' => ['label' => trans('rma::app.admin.return-requests.datagrid.rejected'), 'class' => 'label-canceled'],
                ];

                $config = $map[$row->status] ?? ['label' => ucfirst($row->status), 'class' => 'label-info'];

                return "<span class='badge {$config['class']}'>{$config['label']}</span>";
            },
        ]);

        $this->addColumn([
            'index'      => 'created_at',
            'label'      => trans('rma::app.admin.return-requests.datagrid.created-at'),
            'type'       => 'datetime',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);
    }

    /**
     * Prepare actions.
     */
    public function prepareActions()
    {
        $this->addAction([
            'icon'   => 'icon-view',
            'title'  => trans('rma::app.admin.return-requests.datagrid.view'),
            'method' => 'GET',
            'url'    => function ($row) {
                return route('admin.rma.return-requests.show', $row->id);
            },
        ]);

        $this->addAction([
            'icon'   => 'icon-delete',
            'title'  => trans('rma::app.admin.return-requests.datagrid.delete'),
            'method' => 'DELETE',
            'url'    => function ($row) {
                return route('admin.rma.return-requests.delete', $row->id);
            },
        ]);
    }

    /**
     * Prepare mass actions.
     */
    public function prepareMassActions()
    {
        $this->addMassAction([
            'icon'   => 'icon-delete',
            'title'  => trans('rma::app.admin.return-requests.datagrid.mass-delete'),
            'method' => 'POST',
            'url'    => route('admin.rma.return-requests.mass-delete'),
        ]);
    }
}

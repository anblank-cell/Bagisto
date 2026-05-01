<?php

return [
    'admin' => [
        'return-requests' => [
            'title'               => 'Return Requests (RMA)',
            'delete-success'      => 'Return request deleted successfully.',
            'mass-delete-success' => 'Selected return requests deleted successfully.',

            'datagrid' => [
                'id'           => 'ID',
                'product-name' => 'Product Name',
                'product-sku'  => 'SKU',
                'status'       => 'Status',
                'created-at'   => 'Created At',
                'pending'      => 'Pending',
                'approved'     => 'Approved',
                'rejected'     => 'Rejected',
                'view'         => 'View',
                'delete'       => 'Delete',
                'mass-delete'  => 'Delete Selected',
            ],

            'show' => [
                'title'        => 'View Return Request',
                'general-info' => 'General Information',
                'product-name' => 'Product Name',
                'status'       => 'Status',
                'reason'       => 'Reason',
                'created-at'   => 'Created At',
            ],
        ],
    ],
];

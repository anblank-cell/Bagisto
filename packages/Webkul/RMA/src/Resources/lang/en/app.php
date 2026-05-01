<?php

return [
    'admin' => [
        'menu' => [
            'rma' => 'RMA',
        ],

        'acl' => [
            'rma' => 'RMA',
            'return-requests' => 'Return Requests',
            'view' => 'View',
        ],

        'system' => [
            'rma'                    => 'RMA',
            'rma-info'               => 'Return Merchandise Authorization settings.',
            'general-settings'       => 'General Settings',
            'general-settings-info'  => 'Configure basic RMA functionality.',
            'rma-configuration'      => 'RMA Configuration',
            'rma-configuration-info' => 'Basic RMA settings and options.',
            'enable-rma'             => 'Enable RMA',
            'allow-partial-returns'  => 'Allow Partial Returns',
            'max-return-days'        => 'Maximum Return Days',
            'enable-auto-approval'   => 'Enable Auto Approval',
            'default-return-status'  => 'Default Return Status',
            'return-email'           => 'Return Request Email',
            'status-pending'         => 'Pending',
            'status-approved'        => 'Approved',
            'status-rejected'        => 'Rejected',
            'return-policy'          => 'Return Policy',
            'return-policy-info'     => 'Configure your store return policy settings.',
            'enable-return-policy'   => 'Enable Return Policy',
            'auto-approve-returns'   => 'Auto Approve Returns',
            'require-return-reason'  => 'Require Return Reason',
            'return-policy-text'     => 'Return Policy Text',
            'validation_example'     => 'Validation Examples',
            'return_email'          => 'Return Request Email',
            'max_return_days'       => 'Maximum Return Days',
            'enable_notifications'  => 'Enable Email Notifications',
            'notification_email'    => 'Notification Email',
            'return_label_logo'     => 'Return Label Logo',
        ],

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

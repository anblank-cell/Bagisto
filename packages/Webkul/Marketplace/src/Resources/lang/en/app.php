<?php

return [
    'admin' => [
        'menu' => [
            'marketplace'  => 'Marketplace',
            'sellers'      => 'Sellers',
            'products'     => 'Products',
            'orders'       => 'Orders',
            'transactions' => 'Transactions',
            'reviews'      => 'Reviews',
            'flag-reasons' => 'Flag Reasons',
        ],

        'acl' => [
            'marketplace'  => 'Marketplace',
            'sellers'      => 'Sellers',
            'products'     => 'Products',
            'orders'       => 'Orders',
            'transactions' => 'Transactions',
            'reviews'      => 'Reviews',
            'flag-reasons' => 'Flag Reasons',
            'view'         => 'View',
            'edit'         => 'Edit',
            'delete'       => 'Delete',
        ],

        'system' => [
            'marketplace'          => 'Marketplace',
            'marketplace-info'     => 'Configure your marketplace settings.',
            'settings'             => 'Settings',
            'settings-info'        => 'General marketplace configuration.',
            'general'              => 'General',
            'enable'               => 'Enable Marketplace',
            'global-commission'    => 'Global Commission (%)',
            'product-approval'     => 'Require Product Approval',
            'seller-approval'      => 'Require Seller Approval',
            'minimum-order-price'  => 'Minimum Order Price',
        ],

        'sellers' => [
            'title'               => 'Sellers',
            'update-success'      => 'Seller updated successfully.',
            'delete-success'      => 'Seller deleted successfully.',
            'approve-success'     => 'Seller approved successfully.',
            'disapprove-success'  => 'Seller disapproved.',
            'mass-delete-success' => 'Selected sellers deleted.',
            'mass-approve-success'=> 'Selected sellers approved.',
            'datagrid' => [
                'id'          => 'ID',
                'shop-title'  => 'Shop',
                'customer'    => 'Customer',
                'email'       => 'Email',
                'commission'  => 'Commission %',
                'status'      => 'Status',
                'approved'    => 'Approved',
                'pending'     => 'Pending',
                'revenue'     => 'Revenue',
                'created-at'  => 'Created At',
                'view'        => 'View',
                'delete'      => 'Delete',
                'mass-delete' => 'Delete Selected',
                'mass-approve'=> 'Approve Selected',
            ],
        ],

        'products' => [
            'title'               => 'Seller Products',
            'approve-success'     => 'Product approved.',
            'disapprove-success'  => 'Product disapproved.',
            'assign-success'      => 'Product assigned to seller.',
            'delete-success'      => 'Product deleted.',
            'mass-delete-success' => 'Selected products deleted.',
            'datagrid' => [
                'sku'         => 'SKU',
                'seller'      => 'Seller',
                'status'      => 'Status',
                'approved'    => 'Approved',
                'pending'     => 'Pending',
                'created-at'  => 'Created At',
                'approve'     => 'Approve',
                'delete'      => 'Delete',
                'mass-delete' => 'Delete Selected',
            ],
        ],

        'orders' => [
            'title'          => 'Marketplace Orders',
            'payout-success' => 'Payout created successfully.',
            'already-paid'   => 'This order has already been paid out.',
            'datagrid' => [
                'order-id'      => 'Order #',
                'seller'        => 'Seller',
                'total'         => 'Total',
                'commission'    => 'Commission',
                'seller-total'  => 'Seller Total',
                'payout-status' => 'Payout',
                'paid'          => 'Paid',
                'unpaid'        => 'Unpaid',
                'created-at'    => 'Created At',
                'view'          => 'View',
            ],
        ],

        'transactions' => [
            'title'          => 'Transactions',
            'create-success' => 'Transaction created successfully.',
            'datagrid' => [
                'seller'         => 'Seller',
                'amount'         => 'Amount',
                'type'           => 'Type',
                'status'         => 'Status',
                'transaction-id' => 'Transaction ID',
                'created-at'     => 'Created At',
            ],
        ],

        'reviews' => [
            'title'              => 'Seller Reviews',
            'approve-success'    => 'Review approved.',
            'disapprove-success' => 'Review rejected.',
            'delete-success'     => 'Review deleted.',
            'datagrid' => [
                'seller'    => 'Seller',
                'reviewer'  => 'Reviewer',
                'rating'    => 'Rating',
                'title'     => 'Title',
                'status'    => 'Status',
                'approved'  => 'Approved',
                'rejected'  => 'Rejected',
                'pending'   => 'Pending',
                'created-at'=> 'Created At',
                'approve'   => 'Approve',
                'delete'    => 'Delete',
            ],
        ],

        'flags' => [
            'title'          => 'Flag Reasons',
            'create-success' => 'Flag reason created.',
            'update-success' => 'Flag reason updated.',
            'delete-success' => 'Flag reason deleted.',
        ],
    ],

    'seller' => [
        'not-approved'   => 'Your seller account is pending approval.',
        'register-success'=> 'Your seller application has been submitted. Please wait for approval.',

        'profile' => [
            'title'          => 'My Profile',
            'update-success' => 'Profile updated successfully.',
        ],

        'products' => [
            'title'          => 'My Products',
            'create-success' => 'Product created successfully.',
            'update-success' => 'Product updated successfully.',
            'delete-success' => 'Product deleted.',
            'assign-success' => 'Product assigned successfully.',
            'import-success' => 'Products imported successfully.',
        ],

        'orders' => [
            'title'            => 'My Orders',
            'cancel-success'   => 'Order cancelled.',
            'invoice-success'  => 'Invoice created.',
            'shipment-success' => 'Shipment created.',
        ],

        'transactions' => [
            'title' => 'My Transactions',
        ],

        'sub-sellers' => [
            'title'          => 'Sub-Sellers',
            'create-success' => 'Sub-seller created.',
            'update-success' => 'Sub-seller updated.',
            'delete-success' => 'Sub-seller deleted.',
        ],
    ],

    'shop' => [
        'review-success' => 'Your review has been submitted and is pending approval.',
        'menu' => [
            'seller-dashboard' => 'Seller Dashboard',
        ],
    ],
];

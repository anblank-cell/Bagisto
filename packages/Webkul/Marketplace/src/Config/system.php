<?php

return [
    [
        'key'  => 'marketplace',
        'name' => 'marketplace::app.admin.system.marketplace',
        'info' => 'marketplace::app.admin.system.marketplace-info',
        'sort' => 1,
    ],
    [
        'key'  => 'marketplace.settings',
        'name' => 'marketplace::app.admin.system.settings',
        'info' => 'marketplace::app.admin.system.settings-info',
        'icon' => 'settings/settings.svg',
        'sort' => 1,
    ],
    [
        'key'    => 'marketplace.settings.general',
        'name'   => 'marketplace::app.admin.system.general',
        'sort'   => 1,
        'fields' => [
            [
                'name'          => 'enable',
                'title'         => 'marketplace::app.admin.system.enable',
                'type'          => 'boolean',
                'default_value' => true,
                'channel_based' => true,
            ],
            [
                'name'          => 'global_commission',
                'title'         => 'marketplace::app.admin.system.global-commission',
                'type'          => 'number',
                'validation'    => 'numeric|min:0|max:100',
                'default_value' => 10,
                'channel_based' => true,
            ],
            [
                'name'          => 'product_approval_required',
                'title'         => 'marketplace::app.admin.system.product-approval',
                'type'          => 'boolean',
                'default_value' => true,
                'channel_based' => true,
            ],
            [
                'name'          => 'seller_approval_required',
                'title'         => 'marketplace::app.admin.system.seller-approval',
                'type'          => 'boolean',
                'default_value' => true,
                'channel_based' => true,
            ],
            [
                'name'          => 'minimum_order_price',
                'title'         => 'marketplace::app.admin.system.minimum-order-price',
                'type'          => 'number',
                'validation'    => 'numeric|min:0',
                'default_value' => 0,
                'channel_based' => true,
            ],
        ],
    ],
];

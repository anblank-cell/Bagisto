<?php

return [
    ['key' => 'marketplace',                    'name' => 'marketplace::app.admin.acl.marketplace',    'route' => 'admin.marketplace.sellers.index',      'sort' => 1],
    ['key' => 'marketplace.sellers',            'name' => 'marketplace::app.admin.acl.sellers',        'route' => 'admin.marketplace.sellers.index',      'sort' => 1],
    ['key' => 'marketplace.sellers.view',       'name' => 'marketplace::app.admin.acl.view',           'route' => 'admin.marketplace.sellers.show',       'sort' => 1],
    ['key' => 'marketplace.sellers.edit',       'name' => 'marketplace::app.admin.acl.edit',           'route' => 'admin.marketplace.sellers.update',     'sort' => 2],
    ['key' => 'marketplace.sellers.delete',     'name' => 'marketplace::app.admin.acl.delete',         'route' => 'admin.marketplace.sellers.delete',     'sort' => 3],
    ['key' => 'marketplace.products',           'name' => 'marketplace::app.admin.acl.products',       'route' => 'admin.marketplace.products.index',     'sort' => 2],
    ['key' => 'marketplace.orders',             'name' => 'marketplace::app.admin.acl.orders',         'route' => 'admin.marketplace.orders.index',       'sort' => 3],
    ['key' => 'marketplace.transactions',       'name' => 'marketplace::app.admin.acl.transactions',   'route' => 'admin.marketplace.transactions.index', 'sort' => 4],
    ['key' => 'marketplace.reviews',            'name' => 'marketplace::app.admin.acl.reviews',        'route' => 'admin.marketplace.reviews.index',      'sort' => 5],
    ['key' => 'marketplace.flag-reasons',       'name' => 'marketplace::app.admin.acl.flag-reasons',   'route' => 'admin.marketplace.flag-reasons.index', 'sort' => 6],
];

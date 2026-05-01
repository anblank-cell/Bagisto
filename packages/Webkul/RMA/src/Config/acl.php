<?php

return [
    // Main RMA permission
    [
        'key'   => 'rma',
        'name'  => 'RMA',  // Consider using translation key: rma::app.admin.acl.rma
        'route' => 'admin.rma.return-requests.index',
        'sort'  => 1,
    ], [
        'key'   => 'rma.return-requests',
        'name'  => 'Return Requests',  // Consider using translation key: rma::app.admin.acl.return-requests
        'route' => 'admin.rma.return-requests.index',
        'sort'  => 1,
    ], [
        'key'   => 'rma.return-requests.view',
        'name'  => 'View',  // Consider using translation key: rma::app.admin.acl.view
        'route' => 'admin.rma.return-requests.view',
        'sort'  => 1,
    ], [
        'key'   => 'rma.return-requests.create',
        'name'  => 'Create',  // Consider using translation key: rma::app.admin.acl.create
        'route' => 'admin.rma.return-requests.create',
        'sort'  => 2,
    ], [
        'key'   => 'rma.return-requests.edit',
        'name'  => 'Edit',  // Consider using translation key: rma::app.admin.acl.edit
        'route' => 'admin.rma.return-requests.edit',
        'sort'  => 3,
    ], [
        'key'   => 'rma.return-requests.delete',
        'name'  => 'Delete',  // Consider using translation key: rma::app.admin.acl.delete
        'route' => 'admin.rma.return-requests.delete',
        'sort'  => 4,
    ], [
        'key'   => 'rma.settings',
        'name'  => 'Settings',  // Consider using translation key: rma::app.admin.acl.settings
        'route' => 'admin.rma.settings.index',
        'sort'  => 2,
    ], [
        'key'   => 'rma.settings.view',
        'name'  => 'View',  // Consider using translation key: rma::app.admin.acl.view
        'route' => 'admin.rma.settings.view',
        'sort'  => 1,
    ], [
        'key'   => 'rma.settings.edit',
        'name'  => 'Edit',  // Consider using translation key: rma::app.admin.acl.edit
        'route' => 'admin.rma.settings.edit',
        'sort'  => 2,
    ],
];
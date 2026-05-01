<?php

return [
    // Main RMA menu item
    [
        'key'   => 'rma',
        'name'  => 'RMA',  // Use 'rma::app.admin.menu.rma' for translations
        'route' => 'admin.rma.return-requests.index',
        'sort'  => 100,
        'icon'  => 'icon-rma',
    ],
    
    // Sub-menu: Return Requests
    [
        'key'   => 'rma.return-requests',
        'name'  => 'Return Requests',  // Use 'rma::app.admin.menu.return-requests' for translations
        'route' => 'admin.rma.return-requests.index',
        'sort'  => 1,
        'icon'  => '',
    ],
    
    // Sub-menu: RMA Settings
    [
        'key'   => 'rma.settings',
        'name'  => 'Settings',  // Use 'rma::app.admin.menu.settings' for translations
        'route' => 'admin.rma.return-requests.index',  // Same route for demo
        'sort'  => 2,
        'icon'  => '',
    ],
    
    // Sub-menu: Reports (if needed)
    [
        'key'   => 'rma.reports',
        'name'  => 'Reports',  // Use 'rma::app.admin.menu.reports' for translations
        'route' => 'admin.rma.return-requests.index',  // Same route for demo
        'sort'  => 3,
        'icon'  => '',
    ],
];
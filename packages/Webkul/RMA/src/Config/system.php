<?php

return [
    [
        'key'  => 'rma',
        'name' => 'rma::app.admin.system.rma',
        'info' => 'rma::app.admin.system.rma-info',
        'sort' => 1,
    ],

    [
        'key'  => 'rma.settings',
        'name' => 'rma::app.admin.system.general-settings',
        'info' => 'rma::app.admin.system.general-settings-info',
        'icon' => 'settings/settings.svg',
        'sort' => 1,
    ],

    [
        'key'    => 'rma.settings.general',
        'name'   => 'rma::app.admin.system.rma-configuration',
        'info'   => 'rma::app.admin.system.rma-configuration-info',
        'sort'   => 1,
        'fields' => [
            [
                'name'          => 'enable',
                'title'         => 'rma::app.admin.system.enable-rma',
                'type'          => 'boolean',
                'default_value' => true,
                'channel_based' => true,
            ],
            [
                'name'          => 'max_return_days',
                'title'         => 'rma::app.admin.system.max-return-days',
                'type'          => 'number',
                'validation'    => 'numeric|min:1|max:365',
                'default_value' => 30,
                'channel_based' => true,
            ],
            [
                'name'          => 'allow_partial_returns',
                'title'         => 'rma::app.admin.system.allow-partial-returns',
                'type'          => 'boolean',
                'default_value' => false,
                'channel_based' => true,
            ],
            [
                'name'          => 'enable_auto_approval',
                'title'         => 'rma::app.admin.system.enable-auto-approval',
                'type'          => 'boolean',
                'default_value' => false,
                'channel_based' => true,
            ],
            [
                'name'          => 'default_return_status',
                'title'         => 'rma::app.admin.system.default-return-status',
                'type'          => 'select',
                'default_value' => 'pending',
                'channel_based' => true,
                'options'       => [
                    ['title' => 'rma::app.admin.system.status-pending',  'value' => 'pending'],
                    ['title' => 'rma::app.admin.system.status-approved', 'value' => 'approved'],
                    ['title' => 'rma::app.admin.system.status-rejected', 'value' => 'rejected'],
                ],
            ],
            [
                'name'          => 'return_email',
                'title'         => 'rma::app.admin.system.return-email',
                'type'          => 'text',
                'validation'    => 'email',
                'default_value' => '',
                'channel_based' => true,
            ],
        ],
    ],

    [
        'key'    => 'rma.settings.return_policy',
        'name'   => 'rma::app.admin.system.return-policy',
        'info'   => 'rma::app.admin.system.return-policy-info',
        'sort'   => 2,
        'fields' => [
            [
                'name'          => 'enable_return_policy',
                'title'         => 'rma::app.admin.system.enable-return-policy',
                'type'          => 'boolean',
                'default_value' => false,
                'channel_based' => true,
            ],
            [
                'name'          => 'auto_approve_returns',
                'title'         => 'rma::app.admin.system.auto-approve-returns',
                'type'          => 'boolean',
                'default_value' => false,
                'channel_based' => true,
                'depends'       => 'enable_return_policy:1',
            ],
            [
                'name'          => 'require_return_reason',
                'title'         => 'rma::app.admin.system.require-return-reason',
                'type'          => 'boolean',
                'default_value' => true,
                'channel_based' => true,
                'depends'       => 'enable_return_policy:1',
            ],
            [
                'name'          => 'return_policy_text',
                'title'         => 'rma::app.admin.system.return-policy-text',
                'type'          => 'textarea',
                'default_value' => '',
                'channel_based' => true,
                'locale_based'  => true,
                'depends'       => 'enable_return_policy:1',
            ],
        ],
    ], 
    [
        'key'    => 'rma.settings.validation_example',
        'name'   => 'RMA Validation Examples',  // Consider using translation key
        'info'   => 'rma::app.admin.system.return-policy-info',
        'sort'   => 1,
        'fields' => [
            [
                'name'       => 'return_email',
                'title'      => 'Return Request Email',  // Consider using translation key
                'type'       => 'text',
                'validation' => 'required|email|max:255',
            ],
            [
                'name'       => 'max_return_days',
                'title'      => 'Maximum Return Days',  // Consider using translation key
                'type'       => 'number',
                'validation' => 'required|numeric|min:1|max:365',
            ],
            [
                'name'       => 'enable_notifications',
                'title'      => 'Enable Email Notifications',  // Consider using translation key
                'type'       => 'boolean',
                'validation' => 'required|boolean',
            ],
            [
                'name'       => 'notification_email',
                'title'      => 'Notification Email',  // Consider using translation key
                'type'       => 'text',
                'validation' => 'required_if:enable_notifications,1|email',
                'depends'    => 'enable_notifications:1',
            ],
            [
                'name'       => 'return_label_logo',
                'title'      => 'Return Label Logo',  // Consider using translation key
                'type'       => 'image',
                'validation' => 'mimes:jpeg,jpg,png|max:2048',
            ],
        ],
    ],
];

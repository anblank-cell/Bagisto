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
        'sort'   => 2,
        'info'   => 'rma::app.admin.system.return-policy-preview',
        'fields' => [
            [
                'name'  => 'enable_return_policy',
                'title' => 'rma::app.admin.system.enable-return-policy',
                'type'  => 'boolean',
            ], [
                'name'       => 'max_return_days',
                'title'      => 'rma::app.admin.system.max-return-days',
                'type'       => 'number',
                'validation' => 'required_if:enable_return_policy,1|numeric|min:1',
                'depends'    => 'enable_return_policy:1',
            ], [
                'name'    => 'auto_approve_returns',
                'title'   => 'rma::app.admin.system.auto-approve-returns',
                'type'    => 'boolean',
                'depends' => 'enable_return_policy:1',
            ], [
                'name'    => 'require_return_reason',
                'title'   => 'rma::app.admin.system.require-return-reason',
                'type'    => 'boolean',
                'depends' => 'enable_return_policy:1',
            ], [
                'name'    => 'return_policy_text',
                'title'   => 'rma::app.admin.system.return-policy-text',
                'type'    => 'textarea',
                'depends' => 'enable_return_policy:1',
            ],
        ],
    ],
];

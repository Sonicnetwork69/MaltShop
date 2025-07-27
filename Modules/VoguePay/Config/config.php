<?php

return [
    'name' => 'VoguePay',

    'alias' => 'voguepay',

    'logo' => 'Modules/VoguePay/Resources/assets/voguepay.jpg',

    // Vogue pay net addon settings

    'options' => [
        ['label' => __('Settings'), 'type' => 'modal', 'url' => 'voguepay.edit'],
        ['label' => __('Vogue Pay Documentation'), 'target' => '_blank', 'url' => 'https://voguepay.com/']
    ],

    /**
     * Vogue pay net data validation
     */
    'validation' => [
        'rules' => [
            'merchantId' => 'required',
            'sandbox' => 'required',
        ],
        'attributes' => [
            'merchantId' => __('Merchant Id'),
            'sandbox' => __('Please specify sandbox enabled/disabled.')
        ]
    ],
    'fields' => [
        'merchantId' => [
            'label' => __('Merchant Id'),
            'type' => 'text',
            'required' => true
        ],
        'instruction' => [
            'label' => __('Instruction'),
            'type' => 'textarea',
        ],
        'sandbox' => [
            'label' => __('Sandbox'),
            'type' => 'select',
            'required' => true,
            'options' => [
                'Enabled' => 1,
                'Disabled' =>  0
            ]
        ],
        'status' => [
            'label' => __('Status'),
            'type' => 'select',
            'required' => true,
            'options' => [
                'Active' => 1,
                'Inactive' =>  0
            ]
        ]
    ],

    'store_route' => 'voguepay.store',
    'developerCode' => '63c80268c94c6',

];

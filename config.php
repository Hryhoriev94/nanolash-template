<?php 
    return [
        'templates' => [
            'home'    => 'home.php',
            'order'   => 'order.php',
            'category' => 'category.php',
            'product' => 'product.php',
            'product-category' => 'product-category.php',
            'contact' => 'contact.php',
            'result'  => 'result.php',
            'pdf'     => 'pdf.php',
            'pack'    => 'pack.php',
            'error' => 'error.php',
            'blog'   => 'blog.php',
        ],
    
        'routing' => [
            '/' => ['template' => 'home', 'alias' => 'home'],
            'zamow' => ['template' => 'order', 'alias' => 'order'],
            'contact' => ['template' => 'contact', 'alias' => 'contact'],
            'payment-error' => ['template' => 'result', 'alias' => 'payment-error'],
            'payment-success' => ['template' => 'result', 'alias' => 'payment-success'],
            '404' => ['template' => 'error', 'alias' => '404'],
                
            'eyelash-serum' => ['template' => 'product', 'type' => 'normal', 'alias' => 'nanolash-es'],
            'mascara-primer' => ['template' => 'product', 'type' => 'normal', 'alias' => 'nanolash-mp'],
            'mascara' => [
                'template' => 'category',
                'alias' => 'nanolash-maskara',
                'products' => [
                    'length-and-curl-mascara' => [
                        'template' => 'product-category', 'type' => 'normal', 'alias' => 'nanolash-lacm'
                    ],
                    'volume-up-mascara' => [
                        'template' => 'product-category', 'type' => 'normal', 'alias' => 'nanolash-vum'
                    ],
                ]
            ],
            'lash-and-brow-shampoo' => [
                'template' => 'product', 'type' => 'normal', 'alias' => 'nanolash-labs'
            ],
            'diy-eyelash-extension' => [
                'template' => 'category',
                'alias' => 'nanolash-diy',
                'products' => [
                    'diy-eyelash-extension-heartbreaker' => [
                        'template' => 'product-category', 'type' => 'category', 'alias' => 'nanolash-diy-heartbreaker'
                    ],
                    'diy-eyelash-extension-charm' => [
                        'template' => 'product-category', 'type' => 'category', 'alias' => 'nanolash-diy-charm'
                    ],
                    'diy-eyelash-extension-innocent' => [
                        'template' => 'product-category', 'type' => 'category', 'alias' => 'nanolash-diy-innocent'
                    ],
                    'diy-eyelash-extension-fantasy' => [
                        'template' => 'product-category', 'type' => 'category', 'alias' => 'nanolash-diy-fantasy'
                    ],
                    'diy-eyelash-extension-classy' => [
                        'template' => 'product-category', 'type' => 'category', 'alias' => 'nanolash-diy-classy'
                    ],
                    'diy-eyelash-extension-divine' => [
                        'template' => 'product-category', 'type' => 'category', 'alias' => 'nanolash-diy-divine'
                    ],
                    'diy-eyelash-extension-harmony' => [
                        'template' => 'product-category', 'type' => 'category', 'alias' => 'nanolash-diy-harmony'
                    ],
                    'diy-eyelash-extension-flirty' => [
                        'template' => 'product-category', 'type' => 'category', 'alias' => 'nanolash-diy-flirty'
                    ],
                ],
            ],
            'lash-lift-kit' => [
                'template' => 'product', 'type' => 'normal', 'alias' => 'nanolash-llk'
            ],
            'volume-lashes' => [
                'template' => 'product', 'type' => 'multi', 'alias' => 'nanolash-vl'
            ],
            'hydrogel-eye-pathes' => [
                'template' => 'product', 'type' => 'normal', 'alias' => 'nanolash-hep'
            ],
            'disposable-mascara-wands' => [
                'template' => 'product', 'type' => 'normal', 'alias' => 'nanolash-dmw'
            ],
            'microbrush-and-applicators' => [
                'template' => 'product', 'type' => 'normal', 'alias' => 'nanolash-maa'
            ],
            'lint-free-applicaotrs' => [
                'template' => 'product', 'type' => 'normal', 'alias' => 'nanolash-lfa'
            ],
        ],
        'dev_mode' => true,
        'cdn' => false,
        'products' => [
            'nanolash-es' => [
                'id' => '11',
                'type' => 'product',
                'price' => 214,
            ],
            'nanolash-vl' => [
                'id' => '12',
                'type' => 'product',
                'variants' => true,
                'price' => 189
            ],
            'nanolash-mp' => [
                'id' => '13',
                'type' => 'product',
                'price' => 111,
            ],
            'nanolash-lacm' => [
                'id' => '14',
                'type' => 'product',
                'price' => 115,
            ],
            'nanolash-vum' => [
                'id' => '15',
                'type' => 'product',
                'price' => 168,
            ],
            'nanolash-diy-charm' => [
                'id' => '100',
                'type' => 'product',
                'price' => 214,
            ],
            'nanolash-diy-innocent' => [
                'id' => '101',
                'type' => 'product',
                'price' => 301,
            ],
            'nanolash-diy-fantasy' => [
                'id' => '102',
                'type' => 'product',
                'price' => 105,
            ],
            'nanolash-diy-classy' => [
                'id' => '103',
                'type' => 'product',
                'price' => 67,
            ],
            'nanolash-diy-divine' => [
                'id' => '104',
                'type' => 'product',
                'price' => 112,
            ],
            'nanolash-diy-harmony' => [
                'id' => '105',
                'type' => 'product',
                'price' => 179,
            ],
            'nanolash-diy-flirty' => [
                'id' => '106',
                'type' => 'product',
                'price' => 213,
            ],

        ],
        'currency' => 'pln',
        'free_shipping' => 250,
    ];



?>
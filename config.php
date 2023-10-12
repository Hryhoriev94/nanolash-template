<?php 
    return [
        'templates' => [
            'home'    => 'home.php',
            'order'   => 'order.php',
            'category' => 'category.php',
            'product' => 'product.php',
            'contact' => 'contact.php',
            'result'  => 'result.php',
            'pdf'     => 'pdf.php',
            'pack'    => 'pack.php',
            'error' => 'error.php',
            'blog'   => 'blog.php',
        ],
    
        'routing' => [
            '/' => ['template' => 'home', 'alias' => 'home'],
            'order' => ['template' => 'order', 'alias' => 'order'],
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
                        'template' => 'product', 'type' => 'category', 'alias' => 'nanolash-lacm'
                    ],
                    'volume-up-mascara' => [
                        'template' => 'product', 'type' => 'category', 'alias' => 'nanolash-vum'
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
                        'template' => 'product', 'type' => 'category', 'alias' => 'nanolash-diy-heartbreaker'
                    ],
                    'diy-eyelash-extension-charm' => [
                        'template' => 'product', 'type' => 'category', 'alias' => 'nanolash-diy-charm'
                    ],
                    'diy-eyelash-extension-innocent' => [
                        'template' => 'product', 'type' => 'category', 'alias' => 'nanolash-diy-innocent'
                    ],
                    'diy-eyelash-extension-fantasy' => [
                        'template' => 'product', 'type' => 'category', 'alias' => 'nanolash-diy-fantasy'
                    ],
                    'diy-eyelash-extension-classy' => [
                        'template' => 'product', 'type' => 'category', 'alias' => 'nanolash-diy-classy'
                    ],
                    'diy-eyelash-extension-devine' => [
                        'template' => 'product', 'type' => 'category', 'alias' => 'nanolash-diy-devine'
                    ],
                    'diy-eyelash-extension-harmony' => [
                        'template' => 'product', 'type' => 'category', 'alias' => 'nanolash-diy-harmony'
                    ],
                    'diy-eyelash-extension-flirty' => [
                        'template' => 'product', 'type' => 'category', 'alias' => 'nanolash-diy-flirty'
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
                'price' => [
                    'pln' => 214,
                    'usd' => 69,
                    'eur' => 52
                ],
            ],
            'nanolash-vl' => [
                'id' => '12',
                'type' => 'product-variant',
                'price' => [
                    'pln' => 189,
                    'usd' => 59,
                    'eur' => 45
                ]
            ],
            'nanolash-mp' => [
                'id' => '13',
                'type' => 'product',
                'price' => [
                    'pln' => 115,
                    'usd' => 22,
                    'eur' => 19
                ],
            ],
            'nanolash-lacm' => [
                'id' => '14',
                'type' => 'product',
                'price' => [
                    'pln' => 115,
                    'usd' => 22,
                    'eur' => 19
                ],
            ],
            'nanolash-vum' => [
                'id' => '15',
                'type' => 'product',
                'price' => [
                    'pln' => 168,
                    'usd' => 22,
                    'eur' => 19
                ],
            ],
        ]
    ];



?>
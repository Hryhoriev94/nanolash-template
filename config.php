<?php 
    return [
        'templates' => [
            'home'    => 'home.php',
            'order'   => 'order.php',
            'products-group' => 'products-group.php',
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
            'perfect-volume' => ['template' => 'product', 'type' => 'multi', 'alias' => 'nanolash-pv'],
            'diy-eyelash-extension' => [
                'template' => 'category',
                'alias' => 'nanolash-diy',
                'products' => [
                    'nanolash-diy-eyelash-extension-heartbreaker' => [
                        'template' => 'product', 'type' => 'category', 'alias' => 'nanolash-diy-heartbreaker'
                    ],
                    'nanolash-diy-eyelash-extension-charm' => [
                        'template' => 'product', 'type' => 'category', 'alias' => 'nanolash-diy-charm'
                    ],
                    'nanolash-diy-eyelash-extension-innocent' => [
                        'template' => 'product', 'type' => 'category', 'alias' => 'nanolash-diy-innocent'
                    ],
                    'nanolash-diy-eyelash-extension-fantasy' => [
                        'template' => 'product', 'type' => 'category', 'alias' => 'nanolash-diy-fantasy'
                    ],
                    'nanolash-diy-eyelash-extension-classy' => [
                        'template' => 'product', 'type' => 'category', 'alias' => 'nanolash-diy-classy'
                    ],
                    'nanolash-diy-eyelash-extension-devine' => [
                        'template' => 'product', 'type' => 'category', 'alias' => 'nanolash-diy-devine'
                    ],
                    'nanolash-diy-eyelash-extension-harmony' => [
                        'template' => 'product', 'type' => 'category', 'alias' => 'nanolash-diy-harmony'
                    ],
                    'nanolash-diy-eyelash-extension-flirty' => [
                        'template' => 'product', 'type' => 'category', 'alias' => 'nanolash-diy-flirty'
                    ],
                ],
            ],
            'volume-up-mascara' => ['template' => 'product', 'alias' => 'nanolash-vm'], 
            'lenght-and-curl-mascara' => ['template' => 'product', 'alias' => 'nanolash-lcm'], 
            'lash-and-brow-shampoo' => ['template' => 'product', 'alias' => 'nanolash-lbs'], 
            'hydrogel-eye-patches' => ['template' => 'product', 'alias' => 'nanolash-hyp'],
        ],
        'dev_mode' => true,
        'cdn' => false,
    ];



?>
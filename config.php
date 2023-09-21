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
                
            'eyelash-serum' => ['template' => 'product', 'alias' => 'nanolash-es'],
            'primer-mascara' => ['template' => 'product', 'alias' => 'nanolash-pm'],
            'volume-up-mascara' => ['template' => 'product', 'alias' => 'nanolash-vm'], 
            'lenght-and-curl-mascara' => ['template' => 'product', 'alias' => 'nanolash-lcm'], 
            'lash-and-brow-shampoo' => ['template' => 'product', 'alias' => 'nanolash-lbs'], 
            'hydrogel-eye-patches' => ['template' => 'product', 'alias' => 'nanolash-hyp'],


        ],

        'dev_mode' => true,
        'cdn' => false,
    ];



?>
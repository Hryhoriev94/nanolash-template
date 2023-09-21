<?php 

return [
    'home' => [

        'critical' => "<link rel=\"preload\" as=\"image\" media=\"(min-width: 0px) and (max-width: 991.98px)\" type=\"image/webp\" href=\"/assets/img/mobile-main.webp\">
        <link rel=\"preload\" as=\"image\" media=\"(min-width: 992px)\" type=\"image/webp\" href=\"/assets/img/main.webp\">",
        'grid' => [
            'nanolash-es' => [
                'thumb' => 'eyelash-serum/nanolash-eyelash-serum-grid-thumb',
            ],
            'nanolash-pm' => [
                'thumb' => 'primer-mascara/nanolash-primer-mascara-grid-thumb',
            ],
            'nanolash-vm' => [
                'thumb' => 'volume-up-mascara/nanolash-volume-up-mascara-grid-thumb',
            ],
            'nanolash-lcm' => [
                'thumb' => 'lenght-curl-mascara/nanolash-length-curl-mascara-grid-thumb',
            ],
            'nanolash-lbs' => [
                'thumb' => 'lash-brow-shampoo/nanolash-lash-brow-shampoo-grid-thumb',
            ],
            'nanolash-hyp' => [
                'thumb' => 'hydrogel-eye-patches/nanolash-hydrogel-eye-patches-grid-thumb',
            ],
        ],
        'gallery' => '/assets/img/home/gallery/gallery'
    ],

    'nanolash-es' => [

        'critical' => "<link rel=\"preload\" as=\"image\" type=\"image/webp\" href=\"/assets/img/products/eyelash-serum/hero/slides/1/nanolash-eyelash-serum-header@xs.webp\" media=\"(min-width: 0px) and (max-width: 575.98px)\">
        <link rel=\"preload\" as=\"image\" type=\"image/webp\" href=\"/assets/img/products/eyelash-serum/hero/slides/1/nanolash-eyelash-serum-header@sm.webp\" media=\"(min-width: 576px) and (max-width: 767.98px)\">
        <link rel=\"preload\" as=\"image\" type=\"image/webp\" href=\"/assets/img/products/eyelash-serum/hero/slides/1/nanolash-eyelash-serum-header@md.webp\" media=\"(min-width: 768px) and (max-width: 991.98px)\">
        <link rel=\"preload\" as=\"image\" type=\"image/webp\" href=\"/assets/img/products/eyelash-serum/hero/slides/1/nanolash-eyelash-serum-header@lg.webp\" media=\"(min-width: 992px) and (max-width: 1399.98px)\">
        <link rel=\"preload\" as=\"image\" type=\"image/webp\" href=\"/assets/img/products/eyelash-serum/hero/slides/1/nanolash-eyelash-serum-header@xxl.webp\" media=\"(min-width: 1400px)\">",

        'hero' => [
            'dots' => [
                '/assets/img/products/eyelash-serum/hero/dots/nanolash-eyelash-serum-header-1', 
                '/assets/img/products/eyelash-serum/hero/dots/nanolash-eyelash-serum-header-2', 
                '/assets/img/products/eyelash-serum/hero/dots/nanolash-eyelash-serum-header-3', 
                '/assets/img/products/eyelash-serum/hero/dots/nanolash-eyelash-serum-header-4',
            ],

            'slides' => [
                [
                    'alt' => 'test1',
                    'type' => 'image',
                    'src' => '/assets/img/products/eyelash-serum/hero/slides/slide-1/nanolash-eyelash-serum-header'
                ],
                [
                    'alt' => 'test2',
                    'type' => 'image',
                    'src' => '/assets/img/products/eyelash-serum/hero/slides/slide-2/nanolash-eyelash-serum-header'
                ],
                [
                    'alt' => 'test3',
                    'type' => 'image',
                    'src' => '/assets/img/products/eyelash-serum/hero/slides/slide-3/nanolash-eyelash-serum-header'
                ],
                [
                    'alt' => 'test4',
                    'type' => 'image',
                    'src' => '/assets/img/products/eyelash-serum/hero/slides/slide-4/nanolash-eyelash-serum-header'
                ],
            ],

        ],

        'icons' => [
            0 => '/assets/img/products/eyelash-serum/nanolash-eyelash-serum-icon-1.svg',
            1 => '/assets/img/products/eyelash-serum/nanolash-eyelash-serum-icon-2.svg',
            2 => '/assets/img/products/eyelash-serum/nanolash-eyelash-serum-icon-3.svg',
            3 => '/assets/img/products/eyelash-serum/nanolash-eyelash-serum-icon-4.svg',
        ],
        'first_order_section' => [
            'background' => [
                'src' => '/assets/img/products/eyelash-serum/parallax/nanolash-eyelash-serum-parallax-front',
                'extension' => 'png'
            ],
            'parallax' => [
                'front' => [
                    'src' => '/assets/img/products/eyelash-serum/parallax/nanolash-eyelash-serum-parallax-front',
                    'extension' => 'png'
                ],
                'back' => [
                    'src' => '/assets/img/products/eyelash-serum/parallax/nanolash-eyelash-serum-parallax-back',
                    'extension' => 'png'
                ],
            ],
        ],
        'gallery' => '/assets/img/products/eyelash-serum/gallery/nanolash-eyelash-serum-gallery',
        'second_order_section' => [
            'background' => [
                'src' => '/assets/img/products/eyelash-serum/nanolash-eyelash-serum-order-bg',
                'extension' => 'jpg'
            ],
        ]
    ],
]

?>
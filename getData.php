<?php 

$products = [
    'nanolash-es' => [
        'id' => '11',
        'type' => 'product',
        'price' => [
            'pln' => 214,
            'usd' => 69,
            'eur' => 52
        ],
    ],
    'nanolash-pv' => [
        'id' => '12',
        'type' => 'product-variant',
        'price' => [
            'pln' => 189,
            'usd' => 59,
            'eur' => 45
        ]
    ]
];

$domains = [
    'nanolash.loc' => [
        'currency' => 'pln'
    ],
    'dev.nanolash.pl' => [
        'currency' => 'pln'
    ]
];

$alias = $_POST['alias'] ?? null;
$domain = $_POST['domain'] ?? null;

$response = [];

if ($domain && isset($domains[$domain])) {
    $response['currency'] = $domains[$domain]['currency'];
}

if($alias) {
    if(isset($products[$alias])) {
        $response['product'] = $products[$alias];
    } else {
        $response['error'] = 'Product not found';
    }
}

echo json_encode($response);

?>

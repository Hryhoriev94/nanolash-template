<?php 

$config = include 'config.php';
$products = $config['products'];


$domains = [
    'nanolash.loc' => [
        'currency' => 'pln'
    ],
    'dev.nanolash.pl' => [
        'currency' => 'pln'
    ],
    'nanolash.hryhoriev.website' => [
        'currency' => 'pln'
    ],
    'nanolash.test' => [
        'currency' => 'pln'
    ]
];


$alias = $_POST['alias'] ?? null;
$domain = $_POST['domain'] ?? null;
$getAllData = $_POST['getAllData'] ?? null;
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

if($getAllData) {
    $response['products'] = $products;
}

echo json_encode($response);

?>

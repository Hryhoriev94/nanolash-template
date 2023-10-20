<?php 

$config = include 'config.php';

$getAllData = $_POST['getAllData'] ?? null;
$response = [];


if($getAllData) {
    $response['products'] = $config['products'];
    $response['currency'] = $config['currency'];
}

echo json_encode($response);

?>

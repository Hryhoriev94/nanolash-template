<?php $alias = getAlias();
$content = getContent('categories')[$alias];
// $faq_content = $content['faq'];
$images = getImages('categories')[$alias];
?>

<?php getComponent('head', [
    'title' => $content['meta-title'],
    'description' => $content['meta-description'],
    'template' => 'category'
]) ?>

<body>
<?php 
getComponent('navbar');

getComponent('products-grid', [
    'products' => $content['grid'],
    'images' => $images['grid'],
    'routing' => $config['routing'],
    'cart' => true
]);
?>

</body>
<?php $alias = getAlias();
$images = getImages($alias);

getComponent('head', [
    'title' => 'test',
    'description' => 'test',
    'template' => 'product'
]); ?>

<body>
<?php getComponent('navbar') ?>
<?php getComponent('product-components/product-hero', [
    'images' => $images['hero']
]) ?>
</body>
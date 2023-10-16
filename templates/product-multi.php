<?php $alias = getAlias();
$images = getImages($alias);
$content = getContent($alias);
// $faq_content = $content['faq'];
getComponent('head', [
    'title' => 'test',
    'description' => 'test',
    'template' => 'product-multi'
]); ?>

<body>
<?php getComponent('navbar') ?>
<?php getComponent('product-components/product-hero', [
    'images' => $images['hero'],
    'content' => $content
]); ?>
<?php getComponent('product-components/section-icons', [
    'images' => $images['icons'],
    'content' => $content['icons_section']
]); ?>

<?php getComponent('product-components/product-effects', [
    'content' => $content['product_effects'],
    'media' => $images['product_effects']
]) ?>
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
?>

<div class="container">
<h1 class="section-title text-center"><?= getContent('categories')[$alias]['title']; ?></h1>
<?php if(isset(getContent('categories')[$alias]['description'])):?>
    <p class="category-description"><?= getContent('categories')[$alias]['description'] ?></p>
<?php endif; ?>

</div>
<?php

getComponent('products-grid', [
    'products' => $content['grid'],
    'images' => $images['grid'],
    'routing' => $config['routing'],
    'cart' => true
]);
?>
<div class="container">
    <div class="hr mt"></div>
</div>

<?php @$content_content = $content['content_1']?>
<?php if(isset($content_content) && $content_content): ?>

<!-- CONTENT -->

<?php getComponent('content', [
    'content' =>  $content_content,
    "border" => true
]) ?>
<!-- CONTENT END -->
<?php endif; ?>

<?php getComponent('socials');
if(isset(getImages('categories')[$alias]['first_order']['background'])) {
    getComponent('product-components/product-order', [
        'products' => $content['grid'],
        'background' => getImages('categories')[$alias]['first_order']['background'],
        'classes' => [
            'align' => 'right',
            'white' => true
        ],
    ]);
}
getComponent('gallery', [
    'alias' => $alias,
    'category' => true,
]);
?>



</body>
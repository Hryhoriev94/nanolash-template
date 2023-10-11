<?php $alias = getAlias();
$images = getImages($alias);
$content = getContent($alias);
$faq_content = $content['faq'];
getComponent('head', [
    'title' => $content['title'],
    'description' => $content['description'],
    'template' => 'product'
]); ?>

<body>
<?php 
getComponent('navbar');
getComponent('product-components/product-hero', [
    'images' => $images['hero'],
    'content' => $content
]); 
getComponent('product-components/section-icons', [
    'images' => $images['icons'],
    'content' => $content['icons_section']
]); 
getComponent('product-components/product-effects', [
    'content' => $content['product_effects'],
    'media' => $images['product_effects']
]);
getComponent('product-components/product-order', [
    'classes' => [
        'align' => 'left',
        'white' => true
    ],
    'parallax' => $images['first_order_section']['parallax'] ?? null,
]);
?>

<?php @$content_content = getContent($alias)['content_1']?>
<?php if(isset($content_content) && $content_content): ?>

<!-- CONTENT -->

<?php getComponent('content', [
    'content' =>  $content_content,
    'image' => $images['content_1'],
]) ?>



<!-- CONTENT END -->
<?php endif; ?>

<?php 
    getComponent('product-components/customers-opinions', ['content' => $content]);
    getComponent('gallery');
    getComponent('product-components/product-order', [
        'background' => $images['second_order_section']['background'],
        'classes' => [
            'white' => true,
            'align' => 'right'
        ]
    ]);
?>





<?php @$content_content = getContent($alias)['content_2']?>
<?php if(isset($content_content) && $content_content): ?>

<!-- CONTENT -->

<?php getComponent('content', [
    'content' =>  $content_content,
    'image' => $images['content_2'],
]) ?>



<!-- CONTENT END -->
<?php endif; ?>

<!-- NEWSLETTER -->

<div class="newsletter-section">
    <div class="container">
        <?php getComponent('newsletter'); ?>
    </div>
</div>

<!-- NEWSLETTER END -->
<?php @$content_content = getContent($alias)['content_3']?>
<?php if(isset($content_content) && $content_content): ?>

<!-- CONTENT -->

<?php getComponent('content', [
    'content' =>  $content_content,
    'image' => $images['content_3'],
]) ?>



<!-- CONTENT END -->
<?php endif; ?>
<?php getComponent('faq', ['title' => $faq_content['title'], 'faq_list' => $faq_content['questions']]) ?>

<div style="display:none" data-product-name="<?= $content['product_name'] ?>"></div>
</body>
<?php $alias = getAlias();
$images = getImages($alias);
$content = getContent($alias);
getComponent('head', [
    'title' => $content['title'],
    'description' => $content['description'],
    'template' => 'product'
]); 

$other = [];

foreach (getImages('categories') as $category => $category_value) {
    if(isset($category_value['other']) && array_key_exists($alias, $category_value['other'])) {
        $other = $category_value['other'];
    }
}

getComponent('navbar');
getComponent('product-components/product-hero', [
    'images' => $images['hero'],
    'content' => $content,
    'other' => $other
]); 
getComponent('content', [
    'content' =>  $content['content_1'],
    "border" => true,
]);
if(isset(getContent($alias)['steps']) && getContent($alias)['steps']) :
getComponent('steps');
endif;
getComponent('product-components/customers-opinions', ['content' => $content]);
getComponent('gallery');
getComponent('product-components/product-order', [
    'background' => $images['order_section']['background'],
    'classes' => [
        'white' => true,
        'align' => 'right',
        'bg-color' => $images['order_section']['background_color'] ?? ''
    ]
]);?>
<section class="mt">
    <?php getComponent('socials'); ?>
</section>
<section>
<?php getComponent('brand-navigation', [
            'productsImg' => true
        ]) ?>
</section>
<div style="display:none" data-product-name="<?= $content['product_name'] ?>"></div>


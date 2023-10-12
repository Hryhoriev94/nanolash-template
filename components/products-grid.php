<?php $config = include 'config.php'; ?>
<div class="container">
<div class="products__grid <?= count($products) == 2 ? 'two' : '' ?>">
    <?php foreach($products as $alias => $product): ?>
        <?php $thumb = @$images[$alias]['thumb']; ?>
        <?php $productURL = getRouteByAlias($alias, $routing); ?>
        <div class="products__item" data-type="<?= $alias ?>" data-product-name-current="<?= $product['title']?>">
            <div class="thumbnail">
                <a href="<?= $productURL ?>">
                    <picture>
                        <?php $path = getImage($thumb); ?>
                        <source type="image/webp" srcset="<?= getFullPath($path,'webp') ?>" />
                        <img alt="" src='<?= getFullPath($path,'png') ?>' loading="lazy" width="100" height="158">
                    </picture>
                </a>
            </div>
            <h3 class="title"><a href="<?= $productURL ?>"><?= $product['title'] ?></a></h3>
            <div class="description"><a href="<?= $productURL ?>"><?= $product['description'] ?></a></div>
            
                <?php if(isset($cart) && $cart): ?>
                    <div class="product-form">
                        <?php getComponent('cart-components/grid-add-to-cart', [
                            'alias' => $alias
                        ]); ?>
                    </div>
                <?php else: ?>
                    <div class="products__item-link__block">
                        <a href="<?= $productURL ?>">
                            <?= getContent('global')['more'];?>
                        </a>
                    </div>

                <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
</div>



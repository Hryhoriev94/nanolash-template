<?php $otherProducts = isset($other) && $other ? $other : false ?>
<?php $routing = CONFIG['routing']; ?>
<?php $alias = getAlias(); ?>
<div class="container padding-top-element">
    <div class="hero">
        <div class="hero__images">
            <?php 
                if(isset($images['dots']) && $images['dots']) {
                    getComponent('product-components/hero-components/dots', [
                        'dots' => $images['dots'],
                    ]);
                }
                if(isset($images['slides']) && $images['slides']) {
                    getComponent('product-components/hero-components/hero-image', [
                        'slides' => $images['slides']
                    ]);
                }
            ?>
        </div>
        <div class="hero__description">
            <h1 class="slogan"><?= $content['slogan']; ?></h1>
            <h2 class="mark_name">
                <span><?= $content['mark_name']; ?></span> <strong><?= mb_strtoupper($content['product_name']); ?></strong>
            </h2>
            <?php if(isset($content['product_data'])) : ?>
                <?php foreach($content['product_data'] as $key => $value): ?>
                    <?php foreach($value as $key_value => $value_value) :?>
                        <p class="capacity"><strong><?= $key_value; ?></strong> <?= $value_value ?></p>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if($otherProducts) : ?>
                <div class="others">
                    <?php foreach($otherProducts as $otherKey => $otherProducts): ?>
                        <?php if($otherKey === $alias): ?>
                            <div class="other-block active">
                                <picture>
                                    <img alt="" src="<?= getImage($otherProducts['src'] . '.' . $otherProducts['extension'])?>">
                                </picture>
                            </div>
                        <?php else: ?>
                            <a class="other-block" href="<?= getRouteByAlias($otherKey, $routing); ?>">
                                <picture>
                                    <img alt="" src="<?= getImage($otherProducts['src'] . '.' . $otherProducts['extension'])?>">
                                </picture>
                            </a>
                        <?php endif;?>
                        
                    <?php endforeach; ?>
                </div>
            <?php endif;?>
            <div class="product-form">
                <?php if (isset($content['product_variants'])): ?>
                    <div class="product__variants">
                        <?php $iterator = 0;?>
                        <?php foreach ($content['product_variants'] as $variant): ?>
                                <h3 class="product__variants__title"><?= $variant['key'] ?></h3>
                                <div class="product__variant <?= $iterator == 0 ? 'large' : '' ?>">
                                <?php $active_iterator = 0; ?>
                                <?php foreach ($variant['values'] as $key => $value): ?>
                                    <span class="product__variant__block <?= $active_iterator == 0 ? 'active' : '' ?>" data-id="<?= $key ?>"><?= $value ?></span>
                                    <?php $active_iterator++; ?>
                                <?php endforeach; ?>
                                </div>
                                <?php $iterator++; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if(isset($content['variants'])): ?>
                <div class="variants"><?= @$content['mark_name'] . ' ' . @$content['product_name']; ?></div>
                <?php endif; ?>
                <div class="hero__actions">
                    <?php 
                        getComponent('cart-components/add-to-cart'); 
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
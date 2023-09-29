<div class="container">
    <div class="hero">
        <div class="hero__images">
            <?php 
                getComponent('product-components/hero-components/dots', [
                    'dots' => $images['dots'],
                ]);
                getComponent('product-components/hero-components/hero-image', [
                    'slides' => $images['slides']
                ]);
            ?>
        </div>
        <div class="hero__description">
            <h1 class="slogan"><?= $content['slogan']; ?></h1>
            <h2 class="mark_name">
                <span><?= @$content['mark_name']; ?></span> <strong><?= @strtoupper($content['product_name']); ?></strong>
            </h2>
            <?php if(isset($content['capacity']) && isset($content['capacity_value'])) : ?>
                <p class="capacity"><strong><?= @$content['capacity']; ?></strong> <?= @$content['capacity_value']?></p>
            <?php endif; ?>
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
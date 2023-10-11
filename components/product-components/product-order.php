<?php $alias = getAlias(); ?>
<section class="product-order <?= $classes['align']?>">
	<div class="product-order__bg-image">
		<?php if(isset($background) && isset($background['src']) && !empty($background['src']) && !empty($background['extension'])):?>
		<picture style="height: 100%">
			<!-- WebP -->
			<source type="image/webp" srcset="<?= $background['src'] . '.webp' ?>">
            <!-- PNG -->
            <source srcset="<?= $background['src'] . '.png' ?>">
			<!-- IMG -->
			<img src="<?= $background['src'] . '.' . $background['extension'] ?>" alt="<?= isset($background['alt']) ? $background['alt'] : '' ?>" loading="lazy" width="233" height="198">
		</picture>
		<?php endif; ?>
	</div>
	<div class="container d-grid">
		<div class="product-order__content product-form">
			<h3 class="product-order__title"><?= getContent($alias)['mark_name'] . ' ' . getContent($alias)['product_name']; ?></h3>
			<div class="product-order__actions">
				<?php getComponent('cart-components/add-to-cart', [
                    'white' => @$classes['white']
                ]) ?>
            </div>
        </div>
        <?php if (isset($parallax) && !empty($parallax)): ?>
        <div class="parallax product-order__image">
            <?php if (isset($parallax['front']) && !empty($parallax['front'])): ?>
            <?php $front = $parallax['front']; ?>
            <div class="parallax__layer parallax__layer--front" data-parallax-speed="-50">
                <?php for ($i = 0; $i < 3; $i++): ?>
                <picture>
                    <!-- WebP -->
                    <source type="image/webp" srcset="<?= $front['src'] . '.webp' ?>">
                    <!-- IMG -->
                    <img src="<?= $front['src'] . '.' . $front['extension'] ?>" class="img-fluid" loading="lazy" alt="<?= isset($front['alt']) ? $front['alt'] : '' ?>" width="480" height="408">
                </picture>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
            <?php if (isset($parallax['back']) && !empty($parallax['back'])): ?>
            <?php $back = $parallax['back']?>
            <div class="parallax__layer parallax__layer--back" data-parallax-speed="-20">
                <?php for ($i = 0; $i < 3; $i++): ?>
                <picture>
                    <!-- WebP -->
                    <source type="image/webp" srcset="<?= $back['src'] . '.webp' ?>">
                    <!-- IMG -->
                    <img src="<?= $back['src'] . '.' . $back['extension'] ?>" class="img-fluid" loading="lazy" alt="<?= isset($back['alt']) ? $back['alt'] : '' ?>" width="480" height="408">
                </picture>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

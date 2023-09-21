<section class="product-order <?= $align ? $align : "left" ?>">
	<?php ?>
	<div class="product-order__bg-image">
		<?php if(isset($background) && isset($background['src']) && !empty($background['src']) && !empty($background['extension'])):?>
		<picture>
			<!-- WebP -->
			<source type="image/webp" srcset="<?= $background['src'] . '.webp' ?>">
			<!-- IMG -->
			<img src="<?= $background['src'] . '.' . $background['extension'] ?>" alt="<?= isset($background['alt']) ? $background['alt'] : '' ?>" loading="lazy">
		</picture>
		<?php ?>
	</div>
	<?php endif; ?>
	<div class="container d-grid">
		<div class="product-order__content">
			<h3 class="product-order__title">Nanobrow Eyebrow Serum</h3>
			<div class="product-order__actions">
				<div class="add-to-cart add-to-cart--white">
					<!-- <div class="add-to-cart__packs">
						<div class="add-to-cart__packs-label">Nanobrow Eyebrow Serum</div>
						<div class="add-to-cart__packs-list">
							<div class="add-to-cart__pack-button variant-color--white active" data-title="Nanobrow Eyebrow Serum" data-img-path="default" data-quantity="1">x1</div>
							<div class="add-to-cart__pack-button variant-color--white" data-title="Nanobrow Eyebrow Serum 2-Pack" data-img-path="nanobrow-es-2" data-quantity="2">x2</div>
							<div class="add-to-cart__pack-button variant-color--white" data-title="Nanobrow Eyebrow Serum 3-Pack" data-img-path="nanobrow-es-3" data-quantity="3">x3</div>
							<div class="add-to-cart__pack-button many variant-color--white" data-title="Więcej" data-img-path="more" data-quantity="4" data-pack-quantity-more="">+</div>
						</div>
					</div> -->
					<div class="add-to-cart__quantity">
						<div class="qnt-counter qnt-counter--btn-small qnt-counter--relative">
							<button type="button" arai-label="minus" class="add-to-cart__quantity__button add-to-cart__minus" disabled="disabled">-</button>
							<input aria-label="counter" type="text" class="qnt-counter__input" value="1">
							<button type="button" label="plus" class="add-to-cart__quantity__button add-to-cart__plus">+</button>
						</div>
					</div>
					<div class="add-to-cart__price">
						<div class="old-price" style="display: none;">214&nbsp;zł</div>
						<div class="new-price">214&nbsp;zł</div>
					</div>
					<div class="add-to-cart__button-block">
						<span style="display: none;"></span>
						<button tyle="button" class="add-to-cart__button " data-id="13" data-quantity="1" title="">Do koszyka</button>
					</div>
				</div>
			</div>
		</div>
		<?php if(isset($parallax)) : ?>
		<div class="parallax product-order__image">
			<?php if(isset($parallax['front']) && !empty($parallax['front'])) : ?>
			<div class="parallax__layer parallax__layer--front" data-parallax-speed="-20">
				<?php for( $i = 0; $i < 3; $i++) :?>
				<picture>
					<!-- WebP -->
					<source type="image/webp" srcset="<?= $parallax['front']['src'] . '.webp' ?>">
					<!-- IMG -->
					<img src="<?= $parallax['front']['src'] . '.' . $parallax['front']['extension'] ?>" class="img-fluid" loading="lazy" alt="<?= isset($parallax['front']['alt']) ? $parallax['front']['alt'] : '' ?>">
				</picture>
				<?php endfor; ?>
			</div>
			<?php endif; ?>
			<?php if(isset($parallax['back']) && !empty($parallax['back'])) : ?>
			<div class="parallax__layer parallax__layer--back" data-parallax-speed="-50">
				<?php for( $i = 0; $i < 3; $i++) :?>
				<picture>
					<!-- WebP -->
					<source type="image/webp" srcset="<?= $parallax['back']['src'] . '.webp' ?>">
					<!-- IMG -->
					<img src="<?= $parallax['back']['src'] . '.' . $parallax['back']['extension'] ?>" class="img-fluid" loading="lazy" alt="<?= isset($parallax['back']['alt']) ? $parallax['back']['alt'] : '' ?>">
				</picture>
				<?php endfor; ?>
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
</section>
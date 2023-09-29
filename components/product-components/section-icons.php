<?php $alias = getAlias(); ?>
<section class="product-icons">
	<div class="container">
		<h2 class="section-title"><?= $content['title'] ?></h2>
		<div class="product-icons__wrapper row">
			<?php foreach($content['icons'] as $key => $icon_description) : ?>
				<?php $icon_image = $images[$key]; ?>
				<div class="product-icons__element">
					<div class="product-icons__image">
						<img src="<?= $icon_image .'--mobile.svg' ?>" class="img-fluid" alt="" width="100" height="74">
					</div>
					<div class="product-icons__description"><span><?= $icon_description ?></span></div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="hr"></div>
	</div>
</section>
<?php $data = require 'data.php'; ?> 
<div class="nav__cart" style="">
	<div class="nav__cart__width-container">
		<div class="nav__cart__wrapper" style="">
			<div class="nav__cart__details">
				<div class="nav__cart__row nav__cart__row--header">
					<div class="nav__cart__cell"><?= getContent('global')['cart']['products']; ?></div>
					<div class="nav__cart__cell"><?= getContent('global')['cart']['quantity']; ?></div>
					<div class="nav__cart__cell"><?= getContent('global')['cart']['price']; ?></div>
					<div class="nav__cart__cell"><?= getContent('global')['cart']['delete']; ?></div>
				</div>
				<div class="nav__cart__row nav__cart__row--footer">
					<div class="nav__cart__cell"><?= getContent('global')['cart']['summary']; ?></div>
					<div class="nav__cart__cell" id="cart-quantity"></div>
					<div class="nav__cart__cell">
						<div class="old-price" id="cart-old-price" style="display: none;"><span><span>&nbsp;<?=$data['currency']?></div>
						<div class="new-price" id="cart-new-price"><span></span>&nbsp;<?=$data['currency']?></div>
					</div>
					<div class="nav__cart__cell"></div>
				</div>
			</div>
			<div class="nav__cart__footer">
				<div class="nav__cart__shipping">
					<div class="shipping">
						<?= getContent('global')['cart']['shipping_price'] . ' ' . CONFIG['free_shipping'] . ' ' . CONFIG['currency']
						?></div>
					<div class="free-shipping"><strong><?= getContent('global')['cart']['free_shipping']; ?></strong></div>
				</div>
				<a href="<?= getRouteByAlias('order') ?>" class="nav__cart__button"><?= getContent('global')['cart']['order']; ?></a>
			</div>
		</div>
		<div class="nav__cart__wrapper nav__cart__wrapper--empty">
			<div class="nav__cart__empty"><?= getContent('global')['cart']['empty_cart']; ?></div>
		</div>
	</div>
</div>
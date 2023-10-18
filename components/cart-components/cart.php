<?php $data = require 'data.php'; ?> 
<div class="nav__cart" style="">
	<div class="nav__cart__width-container">
		<div class="nav__cart__wrapper" style="">
			<div class="nav__cart__details">
				<div class="nav__cart__row nav__cart__row--header">
					<div class="nav__cart__cell">Produkty</div>
					<div class="nav__cart__cell">Ilość</div>
					<div class="nav__cart__cell">Cena</div>
					<div class="nav__cart__cell">Usuń</div>
				</div>
				<div class="nav__cart__row nav__cart__row--footer">
					<div class="nav__cart__cell">Razem</div>
					<div class="nav__cart__cell" id="cart-quantity"></div>
					<div class="nav__cart__cell">
						<div class="old-price" id="cart-old-price" style="display: none;"><span><span>&nbsp;<?=$data['currency']?></div>
						<div class="new-price" id="cart-new-price"><span></span>&nbsp;<?=$data['currency']?></div>
					</div>
					<div class="nav__cart__cell"></div>
				</div>
			</div>
			<div class="nav__cart__footer">
				<div class="nav__cart__shipping">Darmowa dostawa od 250&nbsp;zł</div>
				<a href="<?= getRouteByAlias('order') ?>" class="nav__cart__button">Zamawiam</a>
			</div>
		</div>
		<div class="nav__cart__wrapper nav__cart__wrapper--empty">
			<div class="nav__cart__empty">Brak produktów w koszyku</div>
		</div>
	</div>
</div>
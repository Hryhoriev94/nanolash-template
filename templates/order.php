<?php 

$alias = getAlias();
$content = getContent($alias);
?>
<?php getComponent('head', [
    'title' => $content['meta-title'],
    'description' => $content['meta-description'],
    'template' => $alias
]) ?>
<body>
    <?php getComponent('navbar') ?>
    <div class="container">
        <h1 class="section-title"><strong>Odkryj piękno</strong> swoich brwi<br> <strong>z Nanolash</strong></h1>
    </div>
    <div class="cart-summary container">
        <div class="cart-summary__wrapper">
            <div class="cart-summary__product">
                <div class="cart-summary__image"></div>
                <div class="cart-summary__details">
					<div class="cart-summary__name"></div>
					<div class="cart-summary__quantity">
						<div class="qnt-counter qnt-counter--relative qnt-counter--btn-small">
							<button type="button" class="qnt-counter__button qnt-counter__button--minus" js-cart-summary-minus="" disabled="disabled" data-type="product">-</button>
							<input type="text" class="qnt-counter__input" value="1" js-cart-summary-quantity="" data-type="product">
							<button type="button" class="qnt-counter__button qnt-counter__button--plus" js-cart-summary-plus="" data-type="product">+</button>
						</div>
					</div>
					<div class="cart-summary__price">
						<div class="old-price"></div>
						<div class="new-price"></div>
					</div>
					<div class="cart-summary__remove">
						<button type="button" class="cart-summary__button" js-cart-summary-remove="" data-type="product"></button>
					</div>
				</div>
            </div>
        </div>
    </div>
</body>
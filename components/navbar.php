<nav class="nav" data-js-navbar="">
	<div class="container">
		<div class="nav__row">
			<?php include __DIR__ . '/navigation-components/hamburger.php'; ?>
			<?php include __DIR__ . '/navigation-components/logo.php'; ?>

			<div class="nav__products" style="display: none">
				<button type="button">Poznaj produkty</button>
			</div>

			<div class="nav__blog" style="display: none">
				<a class="nav-link" href="#">Blog</a>
			</div>
			
			<div class="nav__flag">
				<button type="button" title="Nanobrow Polska" class="flag flag--pl">PL</button>
			</div>

			<div class="nav__cart--button" data-cart__button>
				<button type="button" aria-label="Koszyk">
					<span class="nav__cart-badge" style="display: none;">0</span>
				</button>
			</div>
		</div>
		<?php getComponent('cart-components/cart') ?>
	</div>

	<?php include __DIR__ . '/navigation-components/menu.php'; ?>
    <?php include __DIR__ . '/navigation-components/flags.php'; ?>
	<?php include __DIR__ . '/navigation-components/cart.php'; ?>
</nav>
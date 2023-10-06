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
					<svg class="cart-icon" width="26" height="26" viewBox="0 0 32 32">
						<g>
							<path class="st0" d="M11.4,28c-1.2,0-2.3-1.1-2.3-2.3c0-1.2,1.1-2.3,2.3-2.3s2.3,1.1,2.3,2.3C13.7,27,12.6,28,11.4,28z M11.4,25.8 L11.4,25.8L11.4,25.8z"/>
							<path class="st0" d="M24.2,28c-1.2,0-2.3-1.1-2.3-2.3c0-1.2,1.1-2.3,2.3-2.3s2.3,1.1,2.3,2.3C26.4,27,25.5,28,24.2,28z M24.2,25.8 L24.2,25.8L24.2,25.8z"/>
							<path class="st0" d="M12,21.1c-1.7,0-3-1.2-3.5-2.9l-2-9.8V8.3L5.7,3.5H2c-0.8,0-1.2-0.6-1.2-1.2S1.4,1.2,2,1.2h4.7 c0.6,0,1.1,0.5,1.2,0.9l0.9,5h18.9c0.3,0,0.6,0.2,0.9,0.5c0.2,0.3,0.3,0.6,0.2,0.9L27,18.3c-0.3,1.7-1.8,2.9-3.5,2.9L12,21.1 C12.2,21.1,12.2,21.1,12,21.1z M9.3,9.4l1.7,8.4c0.2,0.6,0.6,0.9,1.2,0.9l0,0h11.4c0.6,0,1.1-0.5,1.2-0.9l1.7-8.4H9.3z"/>
						</g>
					</svg>
					<span class="nav__cart-badge">0</span>
				</button>
			</div>
		</div>
		<?php getComponent('cart-components/cart') ?>
	</div>

	<?php include __DIR__ . '/navigation-components/menu.php'; ?>
    <?php include __DIR__ . '/navigation-components/flags.php'; ?>
	<?php include __DIR__ . '/navigation-components/cart.php'; ?>
</nav>
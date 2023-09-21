<?php $alias = getAlias();
$images = getImages($alias);
$content = getContent($alias);
$faq_content = $content['faq'];
getComponent('head', [
    'title' => 'test',
    'description' => 'test',
    'template' => 'product'
]); ?>

<body>
<?php getComponent('navbar') ?>
<?php getComponent('product-components/product-hero', [
    'images' => $images['hero'],
    'content' => $content
]); ?>
<?php getComponent('product-components/section-icons', [
    'images' => $images['icons'],
    'content' => $content['icons_section']
]); ?>

<section class="product-effects container">
        <h2 class="section-title product-effects__title"><?= $content['prodcut_effects']['title']?></h2>
        <div class="product-effects__content"><?= $content['prodcut_effects']['content'] ?></div>				
            <div class="product-effects__slider">
                <div class="product-effects__before">
                    <picture>
                        <source type="image/webp" srcset="/assets/img/products/eyelash-serum/nanolash-eyelash-serum-effects-before.webp">
                        <img class="d-block" src="/assets/img/products/eyelash-serum/nanolash-eyelash-serum-effects-before.jpg" alt="" width="386" height="267" loading="lazy">
                    </picture>
                </div>
                <div class="product-effects__after">
                    <picture>
                        <source type="image/webp" srcset="/assets/img/products/eyelash-serum/nanolash-eyelash-serum-effects-after.webp">
                        <img class="d-block" src="/assets/img/products/eyelash-serum/nanolash-eyelash-serum-effects-after.jpg" alt="" width="386" height="267" loading="lazy">
                    </picture>
                </div>
                <div class="product-effects__controls">
                    <div class="product-effects__handler"></div>
                </div>
            </div>
        </div>
</section>

<!-- ORDER -->

<section class="product-order left">

    <?php $background = $images['first_order_section']['background']; ?>
    <div class="product-order__bg-image d-block d-lg-none">
        <?php if (isset($background) && isset($background['src']) && !empty($background['src']) && isset($background['extension']) && !empty($background['extension'])): ?>
        <picture>
            <!-- WebP -->
            <source type="image/webp" srcset="<?= $background['src'] . '.webp' ?>">
            <!-- IMG -->
            <img src="<?= $background['src'] . '.' . $background['extension'] ?>" alt="<?= isset($background['alt']) ? $background['alt'] : '' ?>" loading="lazy" width="233" height="198">
        </picture>
        <?php endif; ?>
    </div>

    <div class="container d-grid">
        <div class="product-order__content">
            <h3 class="product-order__title">Nanobrow Eyebrow Serum</h3>
            <div class="product-order__actions">
                <div class="add-to-cart add-to-cart--white">
                    <div class="add-to-cart__quantity">
                        <div class="qnt-counter qnt-counter--btn-small qnt-counter--relative">
                            <button type="button" aria-label="minus" class="add-to-cart__quantity__button add-to-cart__minus" disabled="disabled">-</button>
                            <input aria-label="counter" type="text" class="qnt-counter__input" value="1">
                            <button type="button" aria-label="plus" class="add-to-cart__quantity__button add-to-cart__plus">+</button>
                        </div>
                    </div>
                    <div class="add-to-cart__price">
                        <div class="old-price" style="display: none;">214&nbsp;zł</div>
                        <div class="new-price">214&nbsp;zł</div>
                    </div>
                    <div class="add-to-cart__button-block">
                        <span style="display: none;"></span>
                        <button type="button" class="add-to-cart__button" data-id="13" data-quantity="1" title="">Do koszyka</button>
                    </div>
                </div>
            </div>
        </div>

        <?php 
        if (isset($images['first_order_section']['parallax'])) {
            $parallax = $images['first_order_section']['parallax'];
        }

        if (!empty($parallax)): ?>
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

<!-- ORDER END -->

<!-- CONTENT -->

<section class="product-content container d-md-grid">
    <h2 class="section-title full">Podkreśl swoje<br><strong>naturalne piękno!</strong></h2>
    <div class="first">
        <p>Naturalnie <strong>gęste brwi</strong> w <strong>niecały miesiąc</strong>? To możliwe! Odżywka na porost brwi Nanobrow ma wszystko, czego potrzebują Twoje brwi, by rosnąć szybciej i wyglądać piękniej.</p>
        <h3 class="section-subtitle">Jak to możliwe?</h3>
        <p>Nanobrow podkreśla naturalne brwi, przyspiesza ich wzrost i hamuje nadmierne wypadanie, dzięki czemu łuk brwiowy <strong>wygląda perfekcyjnie nawet bez makijażu</strong>. Odżywka do brwi działa podobnie jak w przypadku rzęs. Rozwiązuje problem cienkich, rzadkich i niewyraźnych brwi u źródła, czyli dostarczając <strong>wszystko to, co jest niezbędne do regeneracji i zachowania pięknego wyglądu</strong>.</p>
    </div>
    
        <div class="product-content__bg-image d-none d-md-block">
            <picture>
                <!-- WebP-->
                <source type="image/webp" srcset="/assets/img/products/eyelash-serum/content-bg.webp">
                <img src="/assets/img/products/eyelash-serum/content-bg.png" alt="" width="640" height="535" loading="lazy">
            </picture>
        </div>
    
    <div class="full">
        <h3 class="section-subtitle">Nanobrow Eyebrow Serum — najlepszy wybór</h3>
        <p>Nanobrow to odżywka, którą pokochały kobiety! Łatwa aplikacja, lekka formuła, która nie obciąża brwi i <strong>zjawiskowe efekty</strong> – to wszystko sprawia, że Nanobrow zbiera <strong>pozytywne recenzje</strong>.</p>
        <p>Ty też możesz dołączyć do grona tych kobiet, które oddały swoje brwi pod opiekę Nanobrow. <strong>Sprawdź, jak piękne mogą być Twoje brwi</strong> i zyskaj więcej pewności siebie dzięki <strong>idealnie podkreślonemu spojrzeniu</strong>. 
        </p>
    </div>
    <div class="hr full"></div>
</section>

<!-- CONTENT END -->

<?php 
    getComponent('product-components/customers-opinions', ['content' => $content]);
    getComponent('gallery');
?>

<!-- ORDER -->

<section class="product-order right">
    <?php $background = $images['second_order_section']['background']; ?>
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
	</div>
</section>

<!-- ORDER END -->

<!-- CONTENT -->

<section class="product-content product-content__wrapper container d-grid">
    <h2 class="product-content__title section-title"><span><strong>Stylizacja brwi</strong></span> prostsza niż myślisz</h2>
    <div class="product-content__content">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet inventore vel consequuntur, temporibus voluptatem recusandae quia nobis libero minus asperiores quas saepe sint perspiciatis accusantium voluptate laboriosam placeat tenetur nesciunt.</p>
        <h3 class="section-subtitle">Jak to możliwe?</h3>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea earum doloremque aspernatur libero. Provident autem alias molestiae esse necessitatibus, illo cupiditate exercitationem facere culpa, explicabo corporis. Ipsum voluptatem excepturi praesentium? Harum commodi itaque, ea dolores sint cum sed. Aperiam deserunt magnam quaerat modi fugiat ipsa eos corrupti in qui eligendi, iure doloribus laborum sunt aut harum voluptates tenetur quas quam.</p>
    </div>
    
        <div class="product-content__image circle border center">
            <picture>
                <!-- WebP-->
                <source type="image/webp" srcset="https://cdn.nanobrow.us/site/assets/img/products/eyelash-serum/nanolash-eyelash-serum-content-img-1.webp">
                <img src="https://cdn.nanobrow.us/site/assets/img/products/eyelash-serum/nanolash-eyelash-serum-content-img-1.gif" alt="" width="376" height="376" loading="lazy">
            </picture>
        </div>
    
    <div class="product-content__extra">
        <h3 class="section-subtitle">Nanobrow Eyebrow Serum — Lorem, ipsum.</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic nisi quaerat illum assumenda, deleniti eligendi saepe accusantium provident dicta rem quasi. Inventore quo deserunt ea iste perferendis, harum obcaecati nobis molestiae, praesentium commodi quaerat, blanditiis exercitationem voluptatibus facere eligendi ex.</p>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corrupti facere debitis impedit, labore minus quasi numquam in soluta eos itaque.</p>
    </div>
    <div class="hr full"></div>
</section>

<!-- CONTENT END -->

<!-- NEWSLETTER -->

<section class="product-order left">

    <?php $background = $images['first_order_section']['background']; ?>
    <div class="product-order__bg-image d-block d-lg-none">
        <?php if (isset($background) && isset($background['src']) && !empty($background['src']) && isset($background['extension']) && !empty($background['extension'])): ?>
        <picture>
            <!-- WebP -->
            <source type="image/webp" srcset="<?= $background['src'] . '.webp' ?>">
            <!-- IMG -->
            <img src="<?= $background['src'] . '.' . $background['extension'] ?>" alt="<?= isset($background['alt']) ? $background['alt'] : '' ?>" loading="lazy" width="233" height="198">
        </picture>
        <?php endif; ?>
    </div>

    <div class="container d-grid">
        <div class="product-order__content">
            <h3 class="product-order__title">Nanobrow Eyebrow Serum</h3>
            <div class="product-order__actions">
                <div class="add-to-cart add-to-cart--white">
                    <div class="add-to-cart__quantity">
                        <div class="qnt-counter qnt-counter--btn-small qnt-counter--relative">
                            <button type="button" aria-label="minus" class="add-to-cart__quantity__button add-to-cart__minus" disabled="disabled">-</button>
                            <input aria-label="counter" type="text" class="qnt-counter__input" value="1">
                            <button type="button" aria-label="plus" class="add-to-cart__quantity__button add-to-cart__plus">+</button>
                        </div>
                    </div>
                    <div class="add-to-cart__price">
                        <div class="old-price" style="display: none;">214&nbsp;zł</div>
                        <div class="new-price">214&nbsp;zł</div>
                    </div>
                    <div class="add-to-cart__button-block">
                        <span style="display: none;"></span>
                        <button type="button" class="add-to-cart__button" data-id="13" data-quantity="1" title="">Do koszyka</button>
                    </div>
                </div>
            </div>
        </div>

        <?php 
        if (isset($images['first_order_section']['parallax'])) {
            $parallax = $images['first_order_section']['parallax'];
        }

        if (!empty($parallax)): ?>
        <div class="parallax product-order__image">
            <?php if (isset($parallax['front']) && !empty($parallax['front'])): ?>
            <?php $front = $parallax['front']; ?>
            <div class="parallax__layer parallax__layer--front">
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
            <div class="parallax__layer parallax__layer--back">
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

<!-- NEWSLETTER END -->

<!-- CONTENT -->

<section class="product-content product-content__wrapper--reverse container d-grid">
    <h2 class="product-content__title section-title"><span><strong>Stylizacja brwi</strong></span> prostsza niż myślisz</h2>
    <div class="product-content__content">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet inventore vel consequuntur, temporibus voluptatem recusandae quia nobis libero minus asperiores quas saepe sint perspiciatis accusantium voluptate laboriosam placeat tenetur nesciunt.</p>
        <h3 class="section-subtitle">Jak to możliwe?</h3>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea earum doloremque aspernatur libero. Provident autem alias molestiae esse necessitatibus, illo cupiditate exercitationem facere culpa, explicabo corporis. Ipsum voluptatem excepturi praesentium? Harum commodi itaque, ea dolores sint cum sed. Aperiam deserunt magnam quaerat modi fugiat ipsa eos corrupti in qui eligendi, iure doloribus laborum sunt aut harum voluptates tenetur quas quam.</p>
    </div>
    
        <div class="product-content__image circle center">
            <picture>
                <!-- WebP-->
                <source type="image/webp" srcset="https://cdn.nanobrow.us/site/assets/img/products/eyelash-serum/nanolash-eyelash-serum-content-img-1.webp">
                <img src="https://cdn.nanobrow.us/site/assets/img/products/eyelash-serum/nanolash-eyelash-serum-content-img-1.gif" alt="" width="376" height="376" loading="lazy">
            </picture>
        </div>
    
    <div class="hr full"></div>
</section>

<?php getComponent('faq', ['title' => $faq_content['title'], 'faq_list' => $faq_content['questions']]) ?>
<!-- CONTENT END -->

</body>
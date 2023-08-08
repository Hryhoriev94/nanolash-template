
<div class="products__grid">
    <?php foreach($products as $alias => $content): ?>
        <?php $thumb = $images[$alias]['thumb']; ?>
        <?php $productURL = getRouteByAlias($alias, $routing); ?>
        <div class="products__item">
            <div class="thumbnail">
                <a href="<?= $productURL ?>">
                    <picture>
                        <source type="image/webp" srcset="<?= '/assets/img/products/' . $thumb . '.webp' ?>" />
                        <img alt="" src="<?= '/assets/img/products/' . $thumb . '.png' ?>" loading="lazy">
                    </picture>
                </a>
            </div>
            <h3 class="title"><a href="<?= $productURL ?>"><?= $content['title'] ?></a></h3>
            <div class="description"><a href="<?= $productURL ?>"><?= $content['description'] ?></a></div>
            <div class="actions">
                <div class="quantity">
                    <button class="plus">-</button>
                    <input value="1" type="text" disabled >
                    <button class="minus">+</button>
                </div>
                <div class="price">9999&nbsp;zł</div>
                <button class="add-to-cart" type="button">
                    <span>Dodaj do koszyka</span>
                </button>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<?php 

$isAlias = isset($alias) && $alias;

if(!$isAlias) {
    $alias = getAlias();
}

$isProducts = isset($products) && !empty($products);
if(!$isProducts) {
    $products = false;
}

$data = require 'data.php'; 
$price = $data['prices'][$alias] ?? 0;
$currency = $data['currency'];
if(isset($white) && $white) {
    $white = 'add-to-cart--white';
} else {
    $white = '';
}

?>

<div class="add-to-cart <?= $white ?>" data-alias="<?= $alias ?>">
    <div class="add-to-cart__quantity">
        <button class="add-to-cart__quantity__button add-to-cart__minus" disabled>-</button>
        <input class="add-to-cart__quantity" value="1">
        <button class="add-to-cart__quantity__button add-to-cart__plus">+</button>
    </div>
    <div class="add-to-cart__summary" price="">
        <div class="old-price">
            <span class="sum"></span>&nbsp;<span class="currency"><?= $currency ?></span>
        </div>
        <div class="new-price">
            <span class="sum"></span>&nbsp;<span class="currency"><?= $currency ?></span>
        </div>
    </div>
    <?php if(isset($select) && $select): ?> 
    <?php $products ? getComponent('cart-components/select', [
                'products' => $select
            ]) : '' 
    ?>
    <?php endif; ?>
    <div class="add-to-cart__button-block">
        <button class="add-to-cart__button"><?= getContent('global')['cart']['add_to_cart']; ?></button>
    </div>
</div>
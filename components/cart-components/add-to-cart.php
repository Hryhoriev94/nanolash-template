<?php 
$alias = getAlias();
$data = require 'data.php'; 
$price = $data['prices'][$alias];
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
            <span class="sum"><?= $price ?></span>&nbsp;<span class="currency"><?= $currency?></span>
        </div>
        <div class="new-price">
            <span class="sum"><?= $price ?></span>&nbsp;<span class="currency"><?= $currency?></span>
        </div>
    </div>
    <div class="add-to-cart__button-block">
        <button class="add-to-cart__button">do koszyka</button>
    </div>
</div>
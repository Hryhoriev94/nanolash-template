<?php 
$alias = getAlias();
$data = require 'data.php'; 
$price = $data['prices'][$alias];
$currency = $data['currency'];
?>

<div class="add-to-cart">
    <div class="add-to-cart__quantity">
        <button class="add-to-cart__quantity__button add-to-cart__minus" disabled>-</button>
        <input class="add-to-cart__quantity" value="1">
        <button class="add-to-cart__quantity__button add-to-cart__plus">+</button>
    </div>
    <div class="add-to-cart__summary"><?= $price . "&nbsp;" . $currency?></div>
    <div class="add-to-cart__button-block">
        <button class="add-to-cart__button">do koszyka</button>
    </div>
</div>
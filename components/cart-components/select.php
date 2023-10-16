<?php $counter = 0; ?>
<div class="add-to-cart__select">
    <div class="display"><span class="current"></span><div class="arrow"></div></div>
    <div class="options-container">
        <?php foreach($products as $alias => $product): ?>
        <div class="option" data-index="<?= $counter++ ?>" data-alias="<?= $alias ?>"><?= $product['title'] ?></div>
        <?php endforeach; ?>
    </div>
</div>
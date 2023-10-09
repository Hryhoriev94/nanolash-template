<?php 
    $brands = getContent('global')['brand_navigation'];
    $brandsImg = getImages('global')['brand_navigation'];
?>



<div class="brands">
    <div class="container">
        <div class="brands__grid">
            <?php foreach ($brands as $name => $brand) :?>
                <?php $isCurrentMark = isCurrentMark($brand['url'])?>
                <a href="<?= $brand['url']?>" class="brands__column <?= $isCurrentMark ? 'current' : ''?>">
                    <h3 class="brand__title"><?= $brand['title']; ?></h3>
                    <img src="<?= getImage($brandsImg[$name]) ?>" alt="<?=$brand['alt']?>" width="230" height="50">
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
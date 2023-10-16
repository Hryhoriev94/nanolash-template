<?php 
    $brands = getContent('global')['brand_navigation'];
    $brandsImg = getImages('global')['brand_navigation'];
    $productsImg = isset($productsImg) && $productsImg ? $productsImg : false;
?>



<div class="brands <?= $productsImg ? 'margin' : '' ?>">
    <div class="container">
            <?php if(!$productsImg): ?>
            <div class="brands__grid">
                <?php foreach ($brands as $name => $brand) :?>
                    <?php $isCurrentMark = isCurrentMark($brand['url'])?>
                    <a href="<?= $brand['url']?>" class="brands__column <?= $isCurrentMark ? 'current' : ''?>">
                        <h3 class="brand__title"><?= $brand['title']; ?></h3>
                        <img src="<?= getImage($brandsImg[$name]) ?>" alt="<?=$brand['alt']?>" width="230" height="50">
                    </a>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="brands__grid images">
                <?php foreach ($brands as $name => $brand) :?>
                    <div class="brands__grid__item">
                        <?php $isCurrentMark = isCurrentMark($brand['url'])?>
                        <div class="brands__grid__item__image-block">
                            <picture>
                                <source type="image/webp" srcset="<?= getImage(getImages('global')['brand_navigation']['images'][$name]); ?>.webp" />
                                <img src="<?= getImage(getImages('global')['brand_navigation']['images'][$name]); ?>.png" alt="" class="brands__grid__item__image" alt="">
                            </picture>
                        </div>
                        <a href="<?= $brand['url']?>" class="brands__column <?= $isCurrentMark ? 'current' : ''?>">
                            <h3 class="brand__title"><?= $brand['title']; ?></h3>
                            <img src="<?= getImage($brandsImg[$name]) ?>" alt="<?=$brand['alt']?>" width="230" height="50">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
    </div>
</div>
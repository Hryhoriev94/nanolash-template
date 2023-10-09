<?php 
$media = getImages(getAlias())['social_wall']; 
?>

<section class="socials">
    <div class="container">
        <div class="socials__wall">
            <div class="socials__title">
                <h2>Social Wall</h2>
            </div>
            <div class="socials__slider">
                <button class="socials__prev socials__control"></button>
                <div class="socials__slides">
                    <?php foreach ($media as $media_block):?>
                        <div class="socials__slide">
                            <picture>
                                <source type="image/webp" srcset="<?= getImage($media_block['src'] . '.webp')?>">
                                <img src="<?= getImage($media_block['src'] . $media_block['img_format'])?>" alt="" loading="lazy">
                            </picture>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="socials__next socials__control"></button>
            </div>
            <div class="socials__links">
                <h4 class="socials__links__title">#nanolash.official</h4>
                <div class="socials__links__follow">
                <img src="<?= getImage('/assets/img/follow_us.svg') ?>" alt="" />
                </div>
                <div class="socials__links__links">
                    <a href=""><img src="<?= getImage('/assets/img/nc-facebook.svg') ?>" alt="" /></a>
                    <a href=""><img src="<?= getImage('/assets/img/nc-instagram.svg') ?>" alt="" /></a>
                    <a href=""><img src="<?= getImage('/assets/img/nc-pinterest.svg') ?>" alt="" /></a>
                    <a href=""><img src="<?= getImage('/assets/img/nc-tiktok.svg') ?>" alt="" /></a>
                    <a href=""><img src="<?= getImage('/assets/img/nc-youtube.svg') ?>" alt="" /></a>
                </div>
            </div>
        </div>
    </div>
</section>
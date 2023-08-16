<div class="hero__image__container">
    <div class="hero__image__block">
        <picture>
            <!-- WebP -->
            <source media="(min-width: 1400px)" type="image/webp" srcset="<?= $slides[0]['src'] . '@xxl.webp' ?>">
            <source media="(min-width: 992px)" type="image/webp" srcset="<?= $slides[0]['src'] . '@lg.webp' ?>">
            <source media="(min-width: 768px)" type="image/webp" srcset="<?= $slides[0]['src'] . '@md.webp' ?>">
            <source media="(min-width: 576px)" type="image/webp" srcset="<?= $slides[0]['src'] . '@sm.webp' ?>">
            <source type="image/webp" srcset="<?= $slides[0]['src'] . '@xs.webp' ?>">
            <!-- PNG -->
            <source media="(min-width: 1400px)" srcset="<?= $slides[0]['src'] . '@xxl.png' ?>">
            <source media="(min-width: 992px)" srcset="<?= $slides[0]['src'] . '@lg.png' ?>">
            <source media="(min-width: 768px)" srcset="<?= $slides[0]['src'] . '@md.png' ?>">
            <source media="(min-width: 576px)" srcset="<?= $slides[0]['src'] . '@sm.png' ?>">
            <source srcset="<?= $slides[0]['src'] . '@xs.png' ?>">
            <!-- IMG -->
            <img class="img-fluid" src="<?= $slides[0]['src'] . '@xs.png' ?>" alt="" width="247" height="auto">
        </picture>
    </div>
    <div class="slides" style="display: none">
        <?php foreach($slides as $index => $slide): ?>
            <span data-slides="<?= $index ?>" 
            <?php foreach($slide as $slideKey => $slideValue) {
                echo "data-$slideKey='$slideValue'";
            }?>
            ></span>
        <?php endforeach;?>
    </div>
</div>
<div class="hero__image__container">
    <div class="hero__image__block">
        <span class="loader"></span>
        <picture>
            <!-- WebP -->
            <source media="(min-width: 0px) and (max-width: 575.98px)" type="image/webp" srcset="<?= $slides[0]['src'] . '@xs.webp' ?>">
            <source media="(min-width: 576px) and (max-width: 767.98px)" type="image/webp" srcset="<?= $slides[0]['src'] . '@sm.webp' ?>">
            <source media="(min-width: 768px) and (max-width: 991.98px)" type="image/webp" srcset="<?= $slides[0]['src'] . '@md.webp' ?>">
            <source media="(min-width: 992px) and (max-width: 1399.98px)" type="image/webp" srcset="<?= $slides[0]['src'] . '@lg.webp' ?>">
            <source media="(min-width: 1400px)" type="image/webp" srcset="<?= $slides[0]['src'] . '@xxl.webp' ?>">

            <!-- PNG -->
            <source media="(min-width: 0px) and max-width(575.98px)" srcset="<?= $slides[0]['src'] . '@xs.png' ?>">
            <source media="(min-width: 576px) and (max-width: 767.98px)" srcset="<?= $slides[0]['src'] . '@sm.png' ?>">
            <source media="(min-width: 768px) and (max-width: 991.98px)" srcset="<?= $slides[0]['src'] . '@md.png' ?>">
            <source media="(min-width: 992px) and (max-width: 1399.98px)" srcset="<?= $slides[0]['src'] . '@lg.png' ?>">
            <source media="(min-width: 1400px)" srcset="<?= $slides[0]['src'] . '@xxl.png' ?>">

            <!-- IMG -->
            <img class="img-fluid" src="<?= $slides[0]['src'] . '@xs.png' ?>" alt="" width="300" height="342">
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
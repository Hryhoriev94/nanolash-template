<?php 
    $gallery = range(1, 20);
    $alias = getAlias();
    $image_name = getImages($alias)['gallery'];
    $extra = '';
    if(isset(getContent($alias)['gallery']['extra'])) {
        $extra = getContent($alias)['gallery']['extra'];
    }
?>
<section class="gallery">
    <div class="gallery__wrapper d-grid">
        <?php foreach($gallery as $index => $img) : ?>
        <?php $number = $index + 1;?>
        <div class="gallery__single">
            <picture>
                <source type="image/webp" srcset='<?="$image_name-$number.webp"?>' />
                <img src='<?="$image_name-$number.jpg" ?>' alt="" width="80" height="80">
            </picture>
        </div>
        <?php endforeach; ?>
    </div>
    <?php if($extra) :?>
        <div class="container">
            <div class="gallery__description">
                <?= $extra ?>
            </div>
            <div class="hr"></div>
        </div>
    <?php endif; ?>
</section>
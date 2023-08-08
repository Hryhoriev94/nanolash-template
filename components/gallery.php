<?php 
    $gallery = range(1, 20);
?>


<div class="gallery__wrapper">
    <?php foreach($gallery as $index => $img) : ?>
    <?php $number = $index + 1;?>
    <div class="gallery__single">
        <picture>
            <source type="image/webp" srcset='<?="/assets/img/$alias/gallery/gallery-$number.webp"?>' />
            <img src='<?="/assets/img/$alias/gallery/gallery-$number.jpg" ?>' alt="">
        </picture>
    </div>
    <?php endforeach; ?>
</div>
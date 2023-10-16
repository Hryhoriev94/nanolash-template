<?php 
    $gallery = range(1, 20);
    $alias = getAlias();
    $isCategory = isset($category) && $category;
    $image_name = '';
    $content = [];

    if($isCategory) {
        $image_name = getImages('categories')[$alias]['gallery'];
        $content = isset(getContent('categories')[$alias]['gallery']) ? getContent('categories')[$alias]['gallery'] : [];
    } else {
        $image_name = getImages($alias)['gallery'];
        $content = isset(getContent($alias)['gallery']) ? getContent($alias)['gallery'] : [];
    }

    $extra = isset($content['extra']) ? $content['extra'] : '';
    $preview = isset($content['preview']) ? $content['preview'] : '';
?>
<section class="gallery">
    <?php if($preview): ?>
        <div class="container">
        <div class="hr"></div>
            <div class="gallery__description preview">
                <p><?= $preview ?><p>
            </div>
        </div>
    <?php endif; ?>
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
                <p><?= $extra ?></p>
            </div>
            <div class="hr"></div>
        </div>
    <?php endif; ?>
</section>
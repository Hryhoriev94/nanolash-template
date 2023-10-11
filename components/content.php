<?php
    $hasContentClasses = isset($content['content_classes']) && $content['content_classes'];
    $hasImage = isset($image['src']) && $image['src'];
    $hasWrapper = isset($image['wrapper']) && $image['wrapper'];
?>

<section class="<?= $content['section_classes'] ?>">
    <?= $content['content_1_1']; ?>
    
    <?php if($hasContentClasses) : ?>
        <div class="<?= $content['content_classes'] ?>">
    <?php endif; ?>
    
    <?php if($hasImage): ?>
        <?= $hasWrapper ? "<div class=\"{$image['wrapper']}\">" : ''; ?>
            <picture>
                <source srcset="<?= $image['src'] ?>.webp" type="image/webp"/>
                <img src="<?= $image['src'] . '.' . $image["extension"] ?>" alt="<?= $content['img_alt'] ?>" loading="lazy" <?= $image['width'] ?>  <?= $image['height'] ?>>
            </picture>
        <?= $hasWrapper ? '</div>' : ''; ?>
    <?php endif; ?>
    
    <?php if($hasContentClasses) : ?>
        </div>
    <?php endif; ?>
    
    <?= $content['content_1_2']; ?>
    <div class="hr full"></div>
</section>

<?php 
    $content = getContent(getAlias())['steps'];
    $images = getImages(getAlias())['steps'];
?>
<div class="container">
    <div class="steps mt">
        <h2 class="section-title product-effects__title"><?= $content['title']; ?></h2>
        <div class="steps-container">
            <?php foreach($content['steps'] as $step_key => $step) : ?>
                <div class="step">
                    <picture>
                        <source type="image/webp" srcset="<?= getImage($images['steps'][$step_key]) . '.' . 'webp'?>">
                        <img src="<?= getImage($images['steps'][$step_key]) . '.' . $images['extension']?>" loading="lazy" class="step-image">
                    </picture>
                    <div class="step-content">
                        <span class="step-number"><?= $step_key + 1 ?></span>
                        <h3 class="step-title"><?= $step['title'] ?></h3>
                        <p class="step-description"><?= $step['description'] ?></p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="hr mt"></div>
</div>

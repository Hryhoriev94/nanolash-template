
<div class="hero__dots" data-visible="5">
    <?php foreach ($dots as $index => $dot) : ?>
        <?php $class = $index == 0 ? 'hero__dot active' : 'hero__dot' ?>
        <div class="<?= $class ?>" data-slide="<?= $index ?>">
            <?php if(isset($dot['type']) && $dot['type'] == 'image'): ?>
                <picture>
                    <source type="image/webp" srcset="<?= $dot['src'] . '.webp' ?>">
                    <img src="<?= $dot['src'] . '.png' ?>" alt="" class="img-fluid" width="60" height="60">
                </picture>
            <?php elseif(isset($dot['type']) && $dot['type'] == 'gif'): ?>
                <picture>
                    <source type="image/webp" srcset="<?= $dot['src'] . '.webp' ?>">
                    <img src="<?= $dot['src'] . '.gif' ?>" alt="" class="img-fluid" width="60" height="60">
                </picture>
            <?php endif; ?>
        </div>

    <?php endforeach; ?>
</div>
<div class="hero__dots" data-visible="5">
    <?php foreach ($dots as $index => $dot) : ?>
    <?php $class = $index == 0 ? 'hero__dot active' : 'hero__dot' ?>
    <div class="<?= $class ?>" data-slide="<?= $index ?>">
        <picture>
            <source type="image/webp" srcset="<?= $dot . '.webp' ?>">
            <img src="<?= $dot . '.png' ?>" alt="" class="img-fluid">
        </picture>
    </div>
    <?php endforeach; ?>
    
</div>
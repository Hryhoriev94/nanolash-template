<section class="product-effects container">
        <h2 class="section-title product-effects__title"><?= $content['title'] ?></h2>
        <div class="product-effects__content"><?= $content['content'] ?></div>
        <?php if($media['type'] === 'slider') : ?>	
            <div class="product-effects__media product-effects--slider">
                <div class="product-effects__before">
                    <picture>
                        <source type="image/webp" srcset="<?= $media['before']['src'] . '.webp'?>">
                        <img class="d-block" src="<?= $media['before']['src'] . '.jpg' ?>" alt="<?= $media['before']['alt'] ?>" width="386" height="267" loading="lazy">
                    </picture>
                </div>
                <div class="product-effects__after">
                    <picture>
                        <source type="image/webp" srcset="<?= $media['after']['src'] . '.webp'?>">
                        <img class="d-block" src="<?= $media['after']['src'] . '.jpg'?>" alt="<?= $media['after']['alt'] ?>" width="386" height="267" loading="lazy">
                    </picture>
                </div>
                <div class="product-effects__controls">
                    <div class="product-effects__handler"></div>
                </div>
            </div>
            <?php elseif($media['type'] === 'video') : ?>
                <div class="product-effects__media product-effects--video">
                    <video width="500" controls="">
                        <source src="<?= $media['src']  . '.webm' ?>" type="video/webm">
                        <source src="<?= $media['src']  . '.mp4' ?>" type="video/mp4">
                    </video>
                </div>
            <?php endif; ?>
        </div>
</section>
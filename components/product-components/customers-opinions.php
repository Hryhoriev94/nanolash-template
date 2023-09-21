<?php $sliderContent = getContent('global')['slider']; ?>
<section class="customers-opinions" data-autoplay="true" data-iteration="10" data-nav-text="<?= $sliderContent['dot'] ?>" data-draggable="true">
    <h2 class="section-title customers-opinions__title">Zaufaj opinii <strong>tysięcy kobiet!</strong></h2>
    <div class="customers-opinions__content">
        <div class="container">
            <div class="customers-opinions__arrows">
                <button class="customers-opinions__arrow customers-opinions__arrow--prev" aria-label="<?= $sliderContent['prev']?>"></button>
                <button class="customers-opinions__arrow customers-opinions__arrow--next" aria-label="<?= $sliderContent['next']?>"></button>
            </div>
            <nav aria-label="<?= $sliderContent['nav'] ?>">
                <ul class="customers-opinions__dots">

                </ul>
            </nav>
            <div class="customers-opinions__wrapper">
                <ul class="customers-opinions__slides" aria-live="polite">
                    <?php foreach ($content['customers__opinions'] as $index => $cnt) : ?>
                    <li class="customers-opinions__slide" data-slide="<?= $index ?>">
                        <blockquote class="customers-opinions__comment">
                            <?= $cnt['comment'] ?>
                            <cite class="customers-opinions__author"><?= $cnt['author'] ?></cite>
                        </blockquote>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

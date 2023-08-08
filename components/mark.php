<?php 

    $img = [
        'one' => '/assets/img/home/nanolash-main-mark-1',
        'two' => '/assets/img/home/nanolash-main-mark-2'
    ];
    $icons = [
        [
            'icon' => '',
            'content' => 'Lashes with 25+ Uses'
        ],
        [
            'icon' => '',
            'content' => 'Premium, Innovative Lash Fibres'
        ],
        [
            'icon' => '',
            'content' => '100% Vegan'
        ],
        [
            'icon' => '',
            'content' => '100% Recyclable Packaging'
        ],
    ];
?>


    <div class="mark__container">
        <div class="mark__text">
            <h2 class="mark__title"><?= $content['mark']['title'] ?></h2>
            <div class="mark__content"><?= $content['mark']['content'] ?></div>
        </div>
        <div class="mark__images">
            <picture>
                    <source type="image/webp" srcset="<?=$img['one'] .'.webp' ?>" />
                    <img src="<?=$img['one'] ?>.jpg" alt="" loading="lazy" class="image--one">
            </picture>
            <picture>
                    <source type="image/webp" srcset="<?=$img['two'] .'.webp' ?>" />
                    <img src="<?=$img['two'] ?>.jpg" alt="" loading="lazy" class="image--two">
            </picture>
        </div>
        <div class="mark__icons icons">
            <?php foreach($icons as $icon): ?>
                <div class="icons__item">
                    <div class="icons__icon"></div>
                    <div class="icons__content"><?= $icon['content'] ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

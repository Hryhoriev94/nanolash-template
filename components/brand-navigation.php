<?php 
    $brands = [
        [
            'url' => 'https://nanolash.pl',
            'name' => 'Nanolash',
            'img' => 'nanolash-logo'
        ],
        [
            'url' => 'https://nanobrow.pl',
            'name' => 'Nanobrow',
            'img' => 'nanobrow-logo'
        ],
    ];
?>



<div class="brands">
    <div class="container">
        <div class="brands__grid">
            <?php foreach ($brands as $value) :?>
                <?php $isCurrentMark = isCurrentMark($value['url'])?>
                <a href="<?= $value['url']?>" class="brands__column <?= $isCurrentMark ? 'current' : ''?>">
                    <?php if(!$isCurrentMark): ?><h3 class="brand__title">POZNAJ NASZE PRODUKTY DO BRWI</h3><?php endif;?>
                    <img src="/assets/img/<?=$value['img']?>.svg" alt="<?=$value['name']?>" width="230" height="50">
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
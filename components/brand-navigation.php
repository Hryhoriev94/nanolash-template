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
                <a href="<?= $value['url']?>" class="brands__column">
                    <source type="image/webp" srcset="<?='/assets/img/' .  $value['img'] . '.webp' ?>" />
                    <img src="<?='/assets/img/' .  $value['img'] . '.png' ?>" alt="<?= $value['name']?>" width="230" height="50">
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
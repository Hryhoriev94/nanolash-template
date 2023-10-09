<?php 
    $img = [
        'one' => '/assets/img/home/nanolash-main-mark-1',
        'one-small' => '/assets/img/home/nanolash-main-mark-sm-1',
        'two' => '/assets/img/home/nanolash-main-mark-2',
        'two-small' => '/assets/img/home/nanolash-main-mark-sm-2',
    ];
?>

<?php foreach($content as $brand): ?>
    <div class="mark__block">
        <div class="mark__container <?= $brand['classes']?>">
            <div class="mark__text">
                <h2 class="mark__title"><?= $brand['title'] ?></h2>
                <div class="mark__content"><?= $brand['content'] ?></div>
            </div>
            <div class="mark__images">
                <picture>
                        <source media="(min-width: 768px)" srcset="https://placehold.co/320x406"/>
                        <img src="https://placehold.co/145x215" alt="" loading="lazy" class="image--one" width="145" height="215">
                </picture>
                <picture>
                        <source media="(min-width: 768px)" srcset="https://placehold.co/320x406"/>
                        <img src="https://placehold.co/145x215" alt="" loading="lazy" class="image--two" width="145" height="215">
                </picture>
            </div>
        </div>
        <div class="mark__icons icons">
            <?php foreach($brand['icons'] as $key => $icon): ?>
                <div class="icons__item">
                    <div class="icons__icon"></div>
                    <div class="icons__content"><?= $icon ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>
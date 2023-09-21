<?php 

$alias = getAlias();
$content = getContent($alias);
$faq_content = $content['faq'];
$images = getImages('home');
?>

<?php getComponent('head', [
    'title' => $content['meta-title'],
    'description' => $content['meta-description'],
    'template' => 'home'
]) ?>

<body>
    <?php getComponent('navbar') ?>
    <?php getComponent('home-components/hero') ?>
    <?php getComponent('brand-navigation') ?>



    <main>
        <div class="container" id="home-page-title">
            <div class="home-page-title">
            <h1 class="home__title"><?= $content['title'] ?></h1>
            <p class="home__description"><?= $content['description'] ?></p>
            <h2 class="home__subtitle"><?= $content['subtitle'] ?></h2>
            <p class="home__subdescriotion"><?= $content['subdescriotion'] ?></p>
            </div>
        </div>
        <div class="container">
            <?php getComponent('products-grid', [
                'products' => $content['grid'],
                'images' => $images['grid'],
                'routing' => $config['routing']
            ]) ?>
        </div>
        <div class="mark__section">
            <div class="container">
                <?php getComponent('mark', [
                    'content' => $content
                ]) ?>
            </div>
        </div>
        <div class="newsletter-section">
            <div class="container">
                <?php getComponent('newsletter'); ?>
            </div>
        </div>
        <div class="container">
            <?php getComponent('follow'); ?>
        </div>
        <?php getComponent('gallery', [
            'alias' => $alias
        ]) ?>
        <?php getComponent('faq', [
            'title' => $faq_content['title'],
            'faq_list' => $faq_content['questions']
        ]) ?>
    </main>

</body>
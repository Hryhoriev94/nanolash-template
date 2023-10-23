<?php 

$alias = getAlias();
$content = getContent($alias);
$faq_content = $content['faq'];
$images = getImages($alias);
?>

<?php getComponent('head', [
    'title' => $content['meta-title'],
    'description' => $content['meta-description'],
    'template' => $alias
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
        <?php getComponent('products-grid', [
            'products' => $content['grid'],
            'images' => $images['grid'],
            'routing' => $config['routing']
        ]) ?>
        <div class="mark__section">
            <div class="container">
                <?php getComponent('brands', [
                    'content' => $content['brands']
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
        <?php getComponent('socials')?>
        <?php getComponent('brand-navigation', [
            'productsImg' => true
        ]) ?>
        <?php getComponent('faq', [
            'title' => $faq_content['title'],
            'faq_list' => $faq_content['questions']
        ]) ?>
    </main>
    <?php getComponent('footer'); ?>
</body>
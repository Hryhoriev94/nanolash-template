<div class="container">
    <div class="hero">
        <div class="hero__images">
            <?php 
                getComponent('product-components/hero-components/dots', [
                    'dots' => $images['dots'],
                ]);
                getComponent('product-components/hero-components/hero-image', [
                    'slides' => $images['slides']
                ]);
            ?>
        </div>
        <div class="hero__description">
            <h1 class="slogan"><?= $content['slogan']; ?></h1>
            <h2 class="mark_name">
                <span><?= $content['mark_name']; ?></span> <strong><?= strtoupper($content['product_name']); ?></strong>
            </h2>
            <p class="capacity"><strong><?= $content['capacity']; ?></strong> <?= $content['capacity_value']?></p>
            <div class="variants"><?= $content['mark_name'] . ' ' . $content['product_name']; ?></div>
            <div class="hero__actions">
                <?php 
                    getComponent('product-components/add-to-cart'); 
                ?>
            </div>
        </div>
    </div>
</div>
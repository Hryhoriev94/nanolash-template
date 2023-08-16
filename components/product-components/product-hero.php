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
    </div>
</div>
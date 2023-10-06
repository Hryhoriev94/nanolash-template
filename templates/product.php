<?php $alias = getAlias();
$images = getImages($alias);
$content = getContent($alias);
$faq_content = $content['faq'];
getComponent('head', [
    'title' => 'test',
    'description' => 'test',
    'template' => 'product'
]); ?>

<body>
<?php 
getComponent('navbar');
getComponent('product-components/product-hero', [
    'images' => $images['hero'],
    'content' => $content
]); 
getComponent('product-components/section-icons', [
    'images' => $images['icons'],
    'content' => $content['icons_section']
]); 
getComponent('product-components/product-effects', [
    'content' => $content['product_effects'],
    'media' => $images['product_effects']
]);
getComponent('product-components/product-order', [
    'classes' => [
        'align' => 'left',
        'white' => true
    ],
    'parallax' => $images['first_order_section']['parallax'] ?? null,
]);
?>

<!-- CONTENT -->

<section class="product-content container d-md-grid">
    <h2 class="section-title full">Podkreśl swoje<br><strong>naturalne piękno!</strong></h2>
    <div class="first">
        <p>Naturalnie <strong>gęste brwi</strong> w <strong>niecały miesiąc</strong>? To możliwe! Odżywka na porost brwi Nanobrow ma wszystko, czego potrzebują Twoje brwi, by rosnąć szybciej i wyglądać piękniej.</p>
        <h3 class="section-subtitle">Jak to możliwe?</h3>
        <p>Nanobrow podkreśla naturalne brwi, przyspiesza ich wzrost i hamuje nadmierne wypadanie, dzięki czemu łuk brwiowy <strong>wygląda perfekcyjnie nawet bez makijażu</strong>. Odżywka do brwi działa podobnie jak w przypadku rzęs. Rozwiązuje problem cienkich, rzadkich i niewyraźnych brwi u źródła, czyli dostarczając <strong>wszystko to, co jest niezbędne do regeneracji i zachowania pięknego wyglądu</strong>.</p>
    </div>
    
        <div class="product-content__bg-image d-none d-md-block">
            <picture>
                <!-- WebP-->
                <source type="image/webp" srcset="/assets/img/products/eyelash-serum/content-bg.webp">
                <img src="/assets/img/products/eyelash-serum/content-bg.png" alt="" width="640" height="535" loading="lazy">
            </picture>
        </div>
    
    <div class="full">
        <h3 class="section-subtitle">Nanobrow Eyebrow Serum — najlepszy wybór</h3>
        <p>Nanobrow to odżywka, którą pokochały kobiety! Łatwa aplikacja, lekka formuła, która nie obciąża brwi i <strong>zjawiskowe efekty</strong> – to wszystko sprawia, że Nanobrow zbiera <strong>pozytywne recenzje</strong>.</p>
        <p>Ty też możesz dołączyć do grona tych kobiet, które oddały swoje brwi pod opiekę Nanobrow. <strong>Sprawdź, jak piękne mogą być Twoje brwi</strong> i zyskaj więcej pewności siebie dzięki <strong>idealnie podkreślonemu spojrzeniu</strong>. 
        </p>
    </div>
    <div class="hr full"></div>
</section>

<!-- CONTENT END -->

<?php 
    getComponent('product-components/customers-opinions', ['content' => $content]);
    getComponent('gallery');
    getComponent('product-components/product-order', [
        'background' => $images['second_order_section']['background'],
        'classes' => [
            'white' => true,
            'align' => 'right'
        ]
    ]);
?>





<!-- CONTENT -->

<section class="product-content product-content__wrapper container d-grid">
    <h2 class="product-content__title section-title"><span><strong>Stylizacja brwi</strong></span> prostsza niż myślisz</h2>
    <div class="product-content__content">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet inventore vel consequuntur, temporibus voluptatem recusandae quia nobis libero minus asperiores quas saepe sint perspiciatis accusantium voluptate laboriosam placeat tenetur nesciunt.</p>
        <h3 class="section-subtitle">Jak to możliwe?</h3>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea earum doloremque aspernatur libero. Provident autem alias molestiae esse necessitatibus, illo cupiditate exercitationem facere culpa, explicabo corporis. Ipsum voluptatem excepturi praesentium? Harum commodi itaque, ea dolores sint cum sed. Aperiam deserunt magnam quaerat modi fugiat ipsa eos corrupti in qui eligendi, iure doloribus laborum sunt aut harum voluptates tenetur quas quam.</p>
    </div>
    
        <div class="product-content__image circle border center">
            <picture>
                <!-- WebP-->
                <source type="image/webp" srcset="https://cdn.nanobrow.us/site/assets/img/products/eyelash-serum/nanolash-eyelash-serum-content-img-1.webp">
                <img src="https://cdn.nanobrow.us/site/assets/img/products/eyelash-serum/nanolash-eyelash-serum-content-img-1.gif" alt="" width="376" height="376" loading="lazy">
            </picture>
        </div>
    
    <div class="product-content__extra">
        <h3 class="section-subtitle">Nanobrow Eyebrow Serum — Lorem, ipsum.</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic nisi quaerat illum assumenda, deleniti eligendi saepe accusantium provident dicta rem quasi. Inventore quo deserunt ea iste perferendis, harum obcaecati nobis molestiae, praesentium commodi quaerat, blanditiis exercitationem voluptatibus facere eligendi ex.</p>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corrupti facere debitis impedit, labore minus quasi numquam in soluta eos itaque.</p>
    </div>
    <div class="hr full"></div>
</section>

<!-- CONTENT END -->

<!-- NEWSLETTER -->

<div class="newsletter-section">
    <div class="container">
        <?php getComponent('newsletter'); ?>
    </div>
</div>

<!-- NEWSLETTER END -->

<!-- CONTENT -->

<section class="product-content product-content__wrapper--reverse container d-grid">
    <h2 class="product-content__title section-title"><span><strong>Stylizacja brwi</strong></span> prostsza niż myślisz</h2>
    <div class="product-content__content">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet inventore vel consequuntur, temporibus voluptatem recusandae quia nobis libero minus asperiores quas saepe sint perspiciatis accusantium voluptate laboriosam placeat tenetur nesciunt.</p>
        <h3 class="section-subtitle">Jak to możliwe?</h3>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea earum doloremque aspernatur libero. Provident autem alias molestiae esse necessitatibus, illo cupiditate exercitationem facere culpa, explicabo corporis. Ipsum voluptatem excepturi praesentium? Harum commodi itaque, ea dolores sint cum sed. Aperiam deserunt magnam quaerat modi fugiat ipsa eos corrupti in qui eligendi, iure doloribus laborum sunt aut harum voluptates tenetur quas quam.</p>
    </div>
    
        <div class="product-content__image circle center">
            <picture>
                <!-- WebP-->
                <source type="image/webp" srcset="https://cdn.nanobrow.us/site/assets/img/products/eyelash-serum/nanolash-eyelash-serum-content-img-1.webp">
                <img src="https://cdn.nanobrow.us/site/assets/img/products/eyelash-serum/nanolash-eyelash-serum-content-img-1.gif" alt="" width="376" height="376" loading="lazy">
            </picture>
        </div>
    
    <div class="hr full"></div>
</section>

<?php getComponent('faq', ['title' => $faq_content['title'], 'faq_list' => $faq_content['questions']]) ?>
<!-- CONTENT END -->

</body>
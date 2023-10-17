<?php $menu = getContent('global')['menu']; ?>

<div class="menu close" id="menu" data-js-menu="">
    <div class="container">
        <div class="menu-elements">
            <?php foreach ($menu as $menu_key => $menu_element_value) : ?>
                <?php $isSubcategories = isset($menu_element_value['links']) && $menu_element_value['links']?>
                <div class="menu-element-container">
                    <div class="menu-element <?= $isSubcategories ? 'links links-close' : '' ?>">
                        <h3 class="menu-element__title"><?= $menu_element_value['title'] ?></h3>
                    </div>
                    <?php if($isSubcategories) : ?>
                        <ul class="menu-element__links">
                        <?php foreach($menu_element_value['links'] as $alias): ?>
                            <li class="menu-element--subelement">
                                <?= getContent('products_names')[$alias]['name'] ?>
                            </li>
                        <?php endforeach;?>
                        </ul>
                    <?php endif;?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
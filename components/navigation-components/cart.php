<div class="nav-cart" style="display: none;">
    <div class="nav-cart__width-container">
        <div class="nav-cart__wrapper" style="display: none;">
            <div class="nav-cart__details">
                <div class="nav-cart__row nav-cart__row--header">
                    <div class="nav-cart__cell">Produkty</div>
                    <div class="nav-cart__cell">Ilość</div>
                    <div class="nav-cart__cell">Cena</div>
                    <div class="nav-cart__cell">Usuń</div>
                </div>

                <div class="nav-cart__row nav-cart__row--footer">
                    <div class="nav-cart__cell"></div>
                    <div class="nav-cart__cell">0</div>
                    <div class="nav-cart__cell">
                        <div class="old-price" style="display: none;">0</div>
                        <div class="new-price">0</div>
                    </div>
                    <div class="nav-cart__cell"></div>
                </div>

            </div>
            <div class="nav-cart__footer">
                <div class="nav-cart__shipping">Darmowa dostawa od 100 PLN</div>
                <a href="<?= getRouteByAlias('order') ?>" class="nav-cart__button">Zamawiam</a>
            </div>
        </div>
        <div class="nav-cart__wrapper">
            <div class="nav-cart__empty">Brak produktów w koszyku</div>
        </div>
    </div>
</div>
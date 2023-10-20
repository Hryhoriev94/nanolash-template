<?php 

$alias = getAlias();
$content = getContent($alias);
?>
<?php getComponent('head', [
    'title' => $content['meta-title'],
    'description' => $content['meta-description'],
    'template' => $alias
]) ?>
<body>
    <?php getComponent('navbar') ?>
    <div class="container">
        <h1 class="section-title"><strong>Odkryj piękno</strong> swoich brwi<br> <strong>z Nanolash</strong></h1>
    </div>
    <section class="cart-summary__section">
        <div class="cart-summary container">
            <div class="cart-summary__wrapper">
            </div>
            <div class="cart-summary__result">
                <?= getContent('global')['cart']['summary']; ?>
                <div id="cart-summary__result"></div>
            </div>
        </div>
    </section>
    <section class="order-form">
        <div class="container">
            <h2 class="section-title" data-nr="2">Adres dostawy</h2>
            <div class="order-form__wrapper ">
                <div class="order-form__element">
                    <select class="order-form__select" name="client_country_id" js-order-form-country-id="" required="">
                        <option value="160">Polska</option>
                    </select>
                    <div class="order-form__label">* Kraj</div>
                </div>
                <div class="order-form__element order-form__element--empty"></div>
                <div class="order-form__element">
                    <input type="email" class="order-form__input" name="client_email" required="">
                    <label class="order-form__label">* E-mail</label>
                </div>
                <div class="order-form__element">
                    <input type="tel" class="order-form__input" name="client_phone" required="">
                    <label class="order-form__label">* Nr telefonu</label>
                </div>
                <div class="order-form__element">
                    <input type="text" class="order-form__input" name="client_name" required="">
                    <label class="order-form__label">* Imię</label>
                </div>
                <div class="order-form__element">
                    <input type="text" class="order-form__input" name="client_last_name" required="">
                    <label class="order-form__label">* Nazwisko</label>
                </div>
                <div class="order-form__element">
                    <input type="text" class="order-form__input" name="client_street" required="">
                    <label class="order-form__label">* Ulica</label>
                </div>
                <div class="order-form__element">
                    <input type="text" class="order-form__input" name="client_building" required="">
                    <label class="order-form__label">* Nr budynku</label>
                </div>
                <div class="order-form__element">
                    <input type="text" class="order-form__input" name="client_house">
                    <label class="order-form__label">Nr mieszkania</label>
                </div>
                <div class="order-form__element">
                    <input type="text" class="order-form__input" pattern="^(?![\d]{2}-[\d]{3}$).*" name="client_city" required="">
                    <label class="order-form__label">* Miasto</label>
                </div>
                <div class="order-form__element">
                    <input type="text" class="order-form__input" pattern="^\d{2}-\d{3}$" name="client_post_code" required="">
                    <label class="order-form__label">* Kod pocztowy</label>
                </div>
                <div class="order-form__info">* - pola wymagane<br>UWAGA: Używaj wyłącznie znaków alfabetu łacińskiego</div>
            </div>
        </div>
    </section>
    <section class="transaction">
    <div class="container">
        <h2 class="section-title" data-nr="3">Dostawa i płatność</h2>

        <div class="transaction__group" js-shipping="">
            <div class="transaction__header">
                <div class="transaction__group-label"><i></i><span>Dostawa</span></div>
            </div>
            <div class="transaction__wrapper">
                <div class="transaction__element transaction__element--selected" data-id="6" data-inpost-modal="" data-service-type="inpost_locker_standard">
                    <div class="transaction__checkbox"><span></span></div>
                    <div class="transaction__image">
                        <img src="https://c.nanolash.com/img/shippers/inpost.svg" class="img-fluid" alt="InPost - Logo">
                    </div>
                    <div class="transaction__details">
                        <div class="transaction__name">Paczkomat InPost 24/7<button type="button" class="button-change-pack">Wybierz paczkomat</button></div>
                        <div class="transaction__cost">
                            Koszt dostawy: <span class="old-price" style="display: none;">10&nbsp;zł</span>
                            <span class="new-price">10&nbsp;zł</span>
                        </div>
                        <div class="transaction__description">
                            Przewidywany czas dostawy od momentu wysyłki to następny dzień roboczy.
                            <div class="pickup-point small" style="">
                                <div style="margin: 5px 0"><strong>Wybrany paczkomat:</strong></div>
                                <div class="pickup-name"></div>
                                <div class="pickup-address"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="transaction__element" data-id="1" data-service-type="">
                    <div class="transaction__checkbox"><span></span></div>
                    <div class="transaction__image">
                        <img src="https://c.nanolash.com/img/shippers/ups.svg" class="img-fluid" alt="UPS - Logo">
                    </div>
                    <div class="transaction__details">
                        <div class="transaction__name">Kurier UPS</div>
                        <div class="transaction__cost">
                            Koszt dostawy: <span class="old-price" style="display: none;">10&nbsp;zł</span>
                            <span class="new-price">10&nbsp;zł</span>
                        </div>
                        <div class="transaction__description">
                            Czas realizacji wyniesie do 2 dni roboczych.
                        </div>
                    </div>
                </div>
                <input type="hidden" name="inp_service_type" value="inpost_locker_standard">
                <input type="hidden" name="inp_target_point" value="">
            </div>
        </div>

        <div class="transaction__group" js-payment="">
            <div class="transaction__header">
                <div class="transaction__group-label"><i></i><span>Płatność</span></div>
            </div>
            <div class="transaction__wrapper">
                <!-- ... все остальные элементы транзакции ... -->
            </div>
            <div class="transaction__checkboxes">
                <div class="checkbox">
                    <label class="checkbox__wrapper">
                        <input type="checkbox" class="checkbox__input" name="checkbox-marketing-agreement">
                        <div class="checkbox__square"></div>
                        <div>Wyrażam zgodę na przetwarzanie moich danych osobowych w celach marketingowych oraz handlowych.</div>
                    </label>
                </div>
            </div>
        </div>

    </div>
</section>

</body>
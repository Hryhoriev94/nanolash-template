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
        <h1 class="section-title"><?= getContent('order')['title']?></h1>
    </div>
    <section class="cart-summary__section">
        <div class="cart-summary container">
            <h2 class="section-title" data-nr="1">Podsumowanie koszyka</h2>
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
                <div class="order-form__element half">
                    <input type="text" class="order-form__input" name="client_building" required="">
                    <label class="order-form__label">* Nr budynku</label>
                </div>
                <div class="order-form__element half">
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
                    <div class="transaction__element transaction__element--selected" data-id="14">
                        <div class="transaction__checkbox"><span></span></div>
                        <div class="transaction__image">
                            <img src="https://c.nanolash.com/img/payments/przelewy24.svg" alt="Przelewy24 - Logo">
                        </div>
                        <div class="transaction__details">
                            <div class="transaction__name">Płacę teraz (Przelewy24)</div>
                            <div class="transaction__description">Zapłać przelewem online, kartą płatniczą, BLIK-iem lub poprzez Google Pay.</div>
                        </div>
                    </div>
                    <div class="transaction__element" data-id="7">
                        <div class="transaction__checkbox"><span></span></div>
                        <div class="transaction__image">
                            <img src="https://c.nanolash.com/img/payments/credit-card.svg" alt="Ilustracja płatności kartą kredytową">
                        </div>
                        <div class="transaction__details">
                            <div class="transaction__name">Płacę teraz (Credit card)</div>
                            <div class="transaction__description">Zapłać teraz kartą kredytową.</div>
                        </div>
                    </div>
                    <div class="transaction__element" data-id="12">
                        <div class="transaction__checkbox"><span></span></div>
                        <div class="transaction__image">
                            <img src="https://c.nanolash.com/img/payments/google-pay.svg" alt="Google Pay - Logo">
                        </div>
                        <div class="transaction__details">
                            <div class="transaction__name">Płacę teraz (Google Pay)</div>
                            <div class="transaction__description">Zapłać teraz za pomocą systemu Google Pay.</div>
                        </div>
                    </div>
                    <div class="transaction__element" data-id="13">
                        <div class="transaction__checkbox"><span></span></div>
                        <div class="transaction__image">
                            <img src="https://c.nanolash.com/img/payments/apple-pay.svg" alt="Apple Pay - Logo">
                        </div>
                        <div class="transaction__details">
                            <div class="transaction__name">Płacę teraz (Apple Pay)</div>
                            <div class="transaction__description">Zapłać teraz za pomocą systemu Apple Pay.</div>
                        </div>
                    </div>
                    <div class="transaction__element" data-id="4">
                        <div class="transaction__checkbox"><span></span></div>
                        <div class="transaction__image">
                            <img src="https://c.nanolash.com/img/payments/paypal.svg" alt="PayPal - Logo">
                        </div>
                        <div class="transaction__details">
                            <div class="transaction__name">Płacę teraz (PayPal)</div>
                            <div class="transaction__description">Zapłać poprzez PayPal.</div>
                        </div>
                    </div>
                    <div class="transaction__element" data-id="1">
                        <div class="transaction__checkbox"><span></span></div>
                        <div class="transaction__image">
                            <img src="https://c.nanolash.com/img/payments/cod.svg" alt="Ilustracja płatności przy odbiorze">
                        </div>
                        <div class="transaction__details">
                            <div class="transaction__name">Płacę przy odbiorze</div>
                            <div class="transaction__cost">(Koszt dostawy: +<span class="new-price">5&nbsp;zł</span>)</div>
                            <div class="transaction__description">Zapłatę przekażesz kurierowi, odbierając przesyłkę.</div>
                        </div>
                    </div>
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
    </section>
    <section class="order-summary">
        <div class="container">
            <h2 class="section-title" data-nr="4">Podsumowanie zamówienia</h2>

            <div class="order-summary__wrapper">
                <div class="order-summary__details">
                    <div class="order-details">
                        <div class="order-details__row" data-js-order-summary-cart-row="">
                            <div class="order-details__label">Zawartość koszyka</div>
                            <div class="order-details__value">
                                <span>
                                    <span class="old-price" style="display: none;">0&nbsp;zł</span>
                                    <span class="new-price">0&nbsp;zł</span>
                                </span>
                            </div>
                        </div>
                        <div class="order-details__row" data-js-order-summary-shipping-row="">
                            <div class="order-details__label">Dostawa</div>
                            <div class="order-details__value">
                                <span>
                                    <span class="old-price" style="display: none;">10&nbsp;zł</span>
                                    <span class="new-price">10&nbsp;zł</span>
                                </span>
                                <div class="order-details__free-shipping">Do darmowej dostawy brakuje 250&nbsp;zł</div>
                            </div>
                        </div>
                        <div class="order-details__row" data-js-order-summary-payment-row="">
                            <div class="order-details__label">Sposób płatności</div>
                            <div class="order-details__value">Płacę teraz (Przelewy24)</div>
                        </div>
                        <div class="order-details__row order-details__row--total" data-js-order-summary-total-row="">
                            <div class="order-details__label">Do zapłaty</div>
                            <div class="order-details__value">
                                <span>
                                    <span class="old-price" style="display: none;">10&nbsp;zł</span>
                                    <span class="new-price">10&nbsp;zł</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-summary__voucher">
                    <div class="voucher" data-js-voucher="">
                        <div class="voucher__title">Posiadasz <strong>kod rabatowy?</strong></div>
                        <form class="voucher__form">
                            <input type="text" class="voucher__input" name="voucher" placeholder="Kod rabatowy" data-js-voucher-input="">
                            <button type="button" class="voucher__button" data-active="Kod aktywny" data-activate="Aktywuj" data-deactivate="Dezaktywuj" js-voucher-button="">Aktywuj</button>
                        </form>
                        <div class="voucher__error" style="display: none;" data-js-voucher-error="">Podany kod rabatowy jest nieprawidłowy</div>
                    </div>
                </div>

                <div class="order-summary__button">
                    <div class="send-order">
                        <div class="send-order__wrapper" data-js-send-order-wrapper="">
                            <button type="button" class="send-order__button" data-js-order-summary-button="" disabled="disabled">Zamawiam teraz</button>
                        </div>
                        <div class="send-order__loader" style="display: none" data-js-send-order-loader=""></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php getComponent('footer'); ?>
</body>
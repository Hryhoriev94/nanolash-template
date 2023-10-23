<section class="faq">
    <div class="container">
        <div class="faq__title"><?= $title ?></div>
        <?php foreach($faq_list as $faq): ?>
        <div class="faq__element">
            <div class="faq__question" data-js-faq-question=""><?= $faq['question'] ?></div>
            <div class="faq__answer" data-js-faq-answer=""><?= $faq['answer'] ?></div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
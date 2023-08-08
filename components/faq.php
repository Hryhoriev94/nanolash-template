<div class="faq">
    <div class="container">
        <div class="faq__title"><?= $title ?></div>
        <?php foreach($faq_list as $faq): ?>
        <details class="faq__element">
            <summary class="faq__question" data-js-faq-question=""><?= $faq['question'] ?></summary>
            <div class="faq__answer" data-js-faq-answer=""><?= $faq['answer'] ?></div>
        </details>
        <?php endforeach; ?>
    </div>
</div>
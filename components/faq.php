<section class="faq">
    <div class="container">
        <div class="faq__container">
            <div class="faq__image">
                <img src="https://placehold.co/425x441" alt="" />
            </div>
            <div>
                <div class="faq__title"><?= $title ?></div>
                <?php foreach($faq_list as $faq): ?>
                <div class="faq__element">
                    <div class="faq__question"><?= $faq['question'] ?></div>
                    <div class="faq__answer"><?= $faq['answer'] ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
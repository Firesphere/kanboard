<details class="accordion-section" <?= empty($events) ? '' : 'open' ?>>
    <summary class="accordion-title"><?= t('Last activity') ?></summary>
    <div class="accordion-content">
        <?= $this->render('event/events', ['events' => $events]) ?>
    </div>
</details>
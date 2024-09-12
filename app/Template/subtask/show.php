<details class="accordion-section" <?= empty($subtasks) ? '' : 'open' ?>>
    <summary class="accordion-title"><?= t('Sub-Tasks') ?></summary>
    <div class="accordion-content">
        <?= $this->render('subtask/table', [
            'subtasks' => $subtasks,
            'task'     => $task,
            'editable' => $editable,
        ]) ?>
    </div>
</details>

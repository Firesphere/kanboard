<details class="accordion-section" <?= empty($files) && empty($images) ? '' : 'open' ?>>
    <summary class="accordion-title"><?= t('Attachments') ?></summary>
    <div class="accordion-content">
        <?= $this->render('task_file/images', ['task' => $task, 'images' => $images]) ?>
        <?= $this->render('task_file/files', ['task' => $task, 'files' => $files]) ?>
    </div>
</details>

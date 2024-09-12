<details class="accordion-section" <?= empty($files) && empty($images) ? '' : 'open' ?>>
    <summary class="accordion-title"><?= t('Attachments') ?></summary>
    <div class="accordion-content">
        <?php if ($this->user->hasProjectAccess('ProjectFileController', 'create', $project['id'])): ?>
            <div class="buttons-header">
                <?= $this->modal->mediumButton('plus', t('Upload a file'), 'ProjectFileController', 'create', ['project_id' => $project['id']]) ?>
            </div>
        <?php endif ?>

        <?= $this->render('project_overview/images', ['project' => $project, 'images' => $images]) ?>
        <?= $this->render('project_overview/files', ['project' => $project, 'files' => $files]) ?>
    </div>
</details>

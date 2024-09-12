<form method="post"
      action="<?= $this->url->href('ExternalTaskCreationController', 'step2', ['project_id' => $project['id'], 'provider_name' => $provider_name]) ?>">
    <?= $this->form->csrf() ?>
    <?= $this->form->hidden('swimlane_id', $values) ?>
    <?= $this->form->hidden('column_id', $values) ?>

    <?= $this->render($template, [
        'project' => $project,
        'values'  => $values,
    ]) ?>

    <?php if (!empty($error_message)): ?>
        <div class="alert alert-error"><?= $this->text->e($error_message) ?></div>
    <?php endif ?>

    <?= $this->modal->submitButtons(['submitLabel' => t('Next')]) ?>
</form>

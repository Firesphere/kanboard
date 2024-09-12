<div class="page-header">
    <h2><?= t('Add a new external link') ?></h2>
</div>

<form action="<?= $this->url->href('TaskExternalLinkController', 'save', ['task_id' => $task['id']]) ?>" method="post"
      autocomplete="off">
    <?= $this->render('task_external_link/form', ['task' => $task, 'dependencies' => $dependencies, 'values' => $values, 'errors' => $errors]) ?>
    <?= $this->modal->submitButtons() ?>
</form>

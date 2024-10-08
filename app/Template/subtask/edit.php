<div class="page-header">
    <h2><?= t('Edit a sub-task') ?></h2>
</div>

<form method="post"
      action="<?= $this->url->href('SubtaskController', 'update', ['task_id' => $task['id'], 'subtask_id' => $subtask['id']]) ?>"
      autocomplete="off">
    <?= $this->form->csrf() ?>

    <?= $this->subtask->renderTitleField($values, $errors, ['autofocus']) ?>
    <?= $this->subtask->renderAssigneeField($users_list, $values, $errors) ?>
    <?= $this->subtask->renderTimeEstimatedField($values, $errors) ?>
    <?= $this->subtask->renderTimeSpentField($values, $errors) ?>

    <?= $this->hook->render('template:subtask:form:edit', ['values' => $values, 'errors' => $errors]) ?>

    <?= $this->modal->submitButtons() ?>
</form>

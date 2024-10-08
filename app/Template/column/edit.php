<div class="page-header">
    <h2><?= t('Edit column "%s"', $column['title']) ?></h2>
</div>

<form method="post"
      action="<?= $this->url->href('ColumnController', 'update', ['project_id' => $project['id'], 'column_id' => $column['id']]) ?>"
      autocomplete="off">
    <?= $this->form->csrf() ?>

    <?= $this->form->label(t('Title'), 'title') ?>
    <?= $this->form->text('title', $values, $errors, ['autofocus', 'required', 'maxlength="191"']) ?>

    <?= $this->form->label(t('Task limit'), 'task_limit') ?>
    <?= $this->form->number('task_limit', $values, $errors, ['min="0"']) ?>

    <?= $this->form->checkbox('hide_in_dashboard', t('Hide tasks in this column in the dashboard'), 1, $values['hide_in_dashboard'] == 1) ?>

    <?= $this->form->label(t('Description'), 'description') ?>
    <?= $this->form->textEditor('description', $values, $errors) ?>

    <?= $this->modal->submitButtons() ?>
</form>

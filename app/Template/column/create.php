<div class="page-header">
    <h2><?= t('Add a new column') ?></h2>
</div>
<form method="post" action="<?= $this->url->href('ColumnController', 'save', ['project_id' => $project['id']]) ?>"
      autocomplete="off">
    <?= $this->form->csrf() ?>

    <?= $this->form->label(t('Title'), 'title') ?>
    <?= $this->form->text('title', $values, $errors, ['autofocus', 'required', 'maxlength="191"', 'tabindex="1"']) ?>

    <?= $this->form->label(t('Task limit'), 'task_limit') ?>
    <?= $this->form->number('task_limit', $values, $errors, ['tabindex="2"', 'min="0"']) ?>

    <?= $this->form->checkbox('hide_in_dashboard', t('Hide tasks in this column in the dashboard'), 1, false, '', ['tabindex' => 3]) ?>

    <?= $this->form->label(t('Description'), 'description') ?>
    <?= $this->form->textEditor('description', $values, $errors, ['tabindex' => 4]) ?>

    <?= $this->modal->submitButtons() ?>
</form>

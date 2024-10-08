<div class="page-header">
    <h2><?= t('Add a new swimlane') ?></h2>
</div>
<form method="post" action="<?= $this->url->href('SwimlaneController', 'save', ['project_id' => $project['id']]) ?>"
      autocomplete="off">
    <?= $this->form->csrf() ?>

    <?= $this->form->label(t('Name'), 'name') ?>
    <?= $this->form->text('name', $values, $errors, ['autofocus', 'required', 'maxlength="191"', 'tabindex="1"']) ?>

    <?= $this->form->label(t('Description'), 'description') ?>
    <?= $this->form->textEditor('description', $values, $errors, ['tabindex' => 2]) ?>

    <?= $this->form->label(t('Task limit'), 'task_limit') ?>
    <?= $this->form->number('task_limit', $values, $errors, ['tabindex' => 3, 'min="0"']) ?>

    <?= $this->modal->submitButtons() ?>
</form>

<div class="page-header">
    <h2><?= t('Predefined Task Description') ?></h2>
</div>
<form method="post"
      action="<?= $this->url->href('PredefinedTaskDescriptionController', 'save', ['project_id' => $project['id']]) ?>"
      autocomplete="off">
    <?= $this->form->csrf() ?>

    <?= $this->form->label(t('Title'), 'title') ?>
    <?= $this->form->text('title', $values, $errors, ['autofocus', 'required', 'tabindex="1"']) ?>

    <?= $this->form->label(t('Description'), 'description') ?>
    <?= $this->form->textEditor('description', $values, $errors, ['tabindex' => 2]) ?>

    <?= $this->modal->submitButtons() ?>
</form>

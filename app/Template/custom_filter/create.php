<div class="page-header">
    <h2><?= t('Add a new filter') ?></h2>
</div>
<form method="post" action="<?= $this->url->href('CustomFilterController', 'save', ['project_id' => $project['id']]) ?>"
      autocomplete="off">
    <?= $this->form->csrf() ?>

    <?= $this->form->label(t('Name'), 'name') ?>
    <?= $this->form->text('name', $values, $errors, ['autofocus', 'required']) ?>

    <?= $this->form->label(t('Filter'), 'filter') ?>
    <?= $this->form->text('filter', $values, $errors, ['required']) ?>

    <?php if ($this->user->hasProjectAccess('ProjectEditController', 'show', $project['id'])): ?>
        <?= $this->form->checkbox('is_shared', t('Share with all project members'), 1) ?>
    <?php endif ?>

    <?= $this->form->checkbox('append', t('Append filter (instead of replacement)'), 1) ?>

    <?= $this->modal->submitButtons() ?>
</form>

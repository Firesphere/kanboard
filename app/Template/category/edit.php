<div class="page-header">
    <h2><?= t('Category modification for the project "%s"', $project['name']) ?></h2>
</div>

<form method="post" action="<?= $this->url->href('CategoryController', 'update', array('project_id' => $project['id'], 'category_id' => $values['id'])) ?>" autocomplete="off">
    <?= $this->form->csrf() ?>

    <?= $this->form->label(t('Category Name'), 'name') ?>
    <?= $this->form->text('name', $values, $errors, array('autofocus', 'required', 'maxlength="50"', 'tabindex="1"')) ?>

    <?= $this->form->label(t('Description'), 'description') ?>
    <?= $this->form->textEditor('description', $values, $errors, array('tabindex' => 2)) ?>

    <?= $this->modal->submitButtons() ?>
</form>

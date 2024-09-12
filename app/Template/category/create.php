<div class="page-header">
    <h2><?= t('Add a new category') ?></h2>
</div>
<form method="post" action="<?= $this->url->href('CategoryController', 'save', ['project_id' => $project['id']]) ?>" autocomplete="off">
    <?= $this->form->csrf() ?>

    <?= $this->form->label(t('Category Name'), 'name') ?>
    <?= $this->form->text('name', $values, $errors, ['autofocus', 'required']) ?>

    <?= $this->form->label(t('Color'), 'color_id') ?>
    <?= $this->form->select('color_id', ['' => t('No color')] + $colors, $values, $errors, [], 'color-picker') ?>

    <?= $this->modal->submitButtons() ?>
</form>

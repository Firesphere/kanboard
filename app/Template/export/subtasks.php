<?= $this->render('export/header', ['project' => $project, 'title' => $title]) ?>

<p class="alert alert-info"><?= t('This report contains all subtasks information for the given date range.') ?></p>

<form class="js-modal-ignore-form" method="post"
      action="<?= $this->url->href('ExportController', 'subtasks', ['project_id' => $project['id']]) ?>"
      autocomplete="off">
    <?= $this->form->csrf() ?>
    <?= $this->form->hidden('project_id', $values) ?>
    <?= $this->form->date(t('Start date'), 'from', $values) ?>
    <?= $this->form->date(t('End date'), 'to', $values) ?>

    <div class="form-actions">
        <button type="submit" class="btn btn-blue js-form-export"><?= t('Export') ?></button>
        <?= t('or') ?>
        <?= $this->url->link(t('cancel'), 'ExportController', 'subtasks', ['project_id' => $project['id']], false, 'js-modal-close') ?>
    </div>
</form>

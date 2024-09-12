<div class="page-header">
    <h2><?= t('Reopen a project') ?></h2>
</div>

<div class="confirm">
    <p class="alert alert-info">
        <?= t('Do you really want to reopen this project: "%s"?', $project['name']) ?>
    </p>

    <?= $this->modal->confirmButtons(
        'ProjectStatusController',
        'enable',
        ['project_id' => $project['id']],
    ) ?>
</div>

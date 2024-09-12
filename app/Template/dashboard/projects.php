<div class="page-header">
    <h2><?= $this->url->link(t('My projects'), 'DashboardController', 'projects', ['user_id' => $user['id']]) ?>
        (<?= $paginator->getTotal() ?>)</h2>
</div>
<?php if ($paginator->isEmpty()): ?>
    <p class="alert"><?= t('You are not a member of any project.') ?></p>
<?php else: ?>
    <div class="table-list">
        <?= $this->render('project_list/header', ['paginator' => $paginator]) ?>
        <?php foreach ($paginator->getCollection() as $project): ?>
            <div class="table-list-row table-border-left">
                <?= $this->render('project_list/project_title', [
                    'project' => $project,
                ]) ?>

                <?= $this->render('project_list/project_details', [
                    'project' => $project,
                ]) ?>

                <?= $this->render('project_list/project_icons', [
                    'project' => $project,
                ]) ?>
            </div>
        <?php endforeach ?>
    </div>

    <?= $paginator ?>
<?php endif ?>

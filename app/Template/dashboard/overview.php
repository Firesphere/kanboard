<?= $this->hook->render('template:dashboard:show:before-filter-box', ['user' => $user]) ?>

<div class="filter-box margin-bottom">
    <form method="get" action="<?= $this->url->dir() ?>" class="search">
        <?= $this->form->hidden('controller', ['controller' => 'SearchController']) ?>
        <?= $this->form->hidden('action', ['action' => 'index']) ?>

        <div class="input-addon">
            <?= $this->form->text('search', [], [], ['placeholder="' . t('Search') . '"', 'aria-label="' . t('Search') . '"'], 'input-addon-field') ?>
            <div class="input-addon-item">
                <?= $this->render('app/filters_helper') ?>
            </div>
        </div>
    </form>
</div>

<?= $this->hook->render('template:dashboard:show:after-filter-box', ['user' => $user]) ?>

<?php if (! $project_paginator->isEmpty()): ?>
    <div class="table-list">
        <?= $this->render('project_list/header', ['paginator' => $project_paginator]) ?>
        <?php foreach ($project_paginator->getCollection() as $project): ?>
            <div class="table-list-row table-border-left">
                <div>
                    <?php if ($this->user->hasProjectAccess('ProjectViewController', 'show', $project['id'])): ?>
                        <?= $this->render('project/dropdown', ['project' => $project]) ?>
                    <?php else: ?>
                        <strong><?= '#' . $project['id'] ?></strong>
                    <?php endif ?>

                    <?= $this->hook->render('template:dashboard:project:before-title', ['project' => $project]) ?>

                    <span class="table-list-title <?= $project['is_active'] == 0 ? 'status-closed' : '' ?>">
                        <?= $this->url->link($this->text->e($project['name']), 'BoardViewController', 'show', ['project_id' => $project['id']]) ?>
                    </span>

                    <?php if ($project['is_private']): ?>
                        <i class="fa fa-lock fa-fw" title="<?= t('Personal project') ?>" role="img" aria-label="<?= t('Personal project') ?>"></i>
                    <?php endif ?>

                    <?= $this->hook->render('template:dashboard:project:after-title', ['project' => $project]) ?>

                </div>
                <div class="table-list-details">
                    <?php foreach ($project['columns'] as $column): ?>
                        <strong title="<?= t('Task count') ?>"><span class="ui-helper-hidden-accessible"><?= t('Task count') ?> </span><?= $column['nb_open_tasks'] ?></strong>
                        <small><?= $this->text->e($column['title']) ?></small>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <?= $project_paginator ?>
<?php endif ?>

<?php if (empty($overview_paginator)): ?>
    <p class="alert"><?= t('There is nothing assigned to you.') ?></p>
<?php else: ?>
    <?php foreach ($overview_paginator as $result): ?>
        <?php if (! $result['paginator']->isEmpty()): ?>
            <div class="page-header">
                <h2 id="project-tasks-<?= $result['project_id'] ?>"><?= $this->url->link($this->text->e($result['project_name']), 'BoardViewController', 'show', ['project_id' => $result['project_id']]) ?></h2>
            </div>

            <div class="table-list">
                <?= $this->render('task_list/header', [
                    'paginator' => $result['paginator'],
                ]) ?>

                <?php foreach ($result['paginator']->getCollection() as $task): ?>
                    <div class="table-list-row color-<?= $task['color_id'] ?>">
                        <?= $this->render('task_list/task_title', [
                            'task'     => $task,
                            'redirect' => 'dashboard',
                        ]) ?>

                        <?= $this->render('task_list/task_details', [
                            'task' => $task,
                        ]) ?>

                        <?= $this->render('task_list/task_avatars', [
                            'task' => $task,
                        ]) ?>

                        <?= $this->render('task_list/task_icons', [
                            'task' => $task,
                        ]) ?>

                        <?= $this->render('task_list/task_subtasks', [
                            'task'    => $task,
                            'user_id' => $user['id'],
                        ]) ?>

                        <?= $this->hook->render('template:dashboard:task:footer', ['task' => $task]) ?>
                    </div>
                <?php endforeach ?>
            </div>

            <?= $result['paginator'] ?>
        <?php endif ?>
    <?php endforeach ?>
<?php endif ?>

<?= $this->hook->render('template:dashboard:show', ['user' => $user]) ?>

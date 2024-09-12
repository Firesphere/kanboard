<div class="page-header">
    <h2><?= $this->url->link(t('My tasks'), 'DashboardController', 'tasks', ['user_id' => $user['id']]) ?> (<?= $paginator->getTotal() ?>)</h2>
</div>
<?php if ($paginator->isEmpty()): ?>
    <p class="alert"><?= t('There is nothing assigned to you.') ?></p>
<?php else: ?>
    <div class="table-list">
        <?= $this->render('task_list/header', [
            'paginator' => $paginator,
        ]) ?>

        <?php foreach ($paginator->getCollection() as $task): ?>
            <div class="table-list-row color-<?= $task['color_id'] ?>">
                <?= $this->render('task_list/task_title', [
                    'task'     => $task,
                    'redirect' => 'dashboard-tasks',
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
                    'task' => $task,
                ]) ?>

                <?= $this->hook->render('template:dashboard:task:footer', ['task' => $task]) ?>
            </div>
        <?php endforeach ?>
    </div>

    <?= $paginator ?>
<?php endif ?>

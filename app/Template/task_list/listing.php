<?= $this->projectHeader->render($project, 'TaskListController', 'show') ?>

<?php if ($paginator->isEmpty()): ?>
    <p class="alert"><?= t('No tasks found.') ?></p>
<?php elseif (!$paginator->isEmpty()): ?>
    <div class="table-list">
        <?= $this->render('task_list/header', [
            'paginator'            => $paginator,
            'project'              => $project,
            'show_items_selection' => true,
        ]) ?>

        <?php foreach ($paginator->getCollection() as $task): ?>
            <div class="table-list-row color-<?= $task['color_id'] ?>">
                <?= $this->render('task_list/task_title', [
                    'task'                 => $task,
                    'show_items_selection' => true,
                    'redirect'             => 'list',
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
            </div>
        <?php endforeach ?>
    </div>

    <?= $paginator ?>
<?php endif ?>

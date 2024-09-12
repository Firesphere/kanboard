<div class="table-list">
    <?= $this->render('task_list/header', [
        'paginator' => $paginator,
    ]) ?>

    <?php foreach ($paginator->getCollection() as $task): ?>
        <div class="table-list-row color-<?= $task['color_id'] ?>">
            <?= $this->render('task_list/task_title', [
                'task' => $task,
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

            <?= $this->hook->render('template:search:task:footer', ['task' => $task]) ?>
        </div>
    <?php endforeach ?>
</div>

<?= $paginator ?>
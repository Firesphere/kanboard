<html>
<body>
<h2><?= $this->text->e($task['title']) ?> (#<?= $task['id'] ?>)</h2>

<p>
    <?= e(
        'This task is now linked to the task %s with the relation "%s"',
        $this->url->absoluteLink(t('#%d', $task_link['opposite_task_id']), 'TaskViewController', 'show', ['task_id' => $task_link['opposite_task_id']]),
        e($task_link['label']),
    ) ?>
</p>

<?= $this->render('notification/footer', ['task' => $task]) ?>
</body>
</html>
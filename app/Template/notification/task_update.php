<html>
<body>
<h2><?= $this->text->e($task['title']) ?> (#<?= $task['id'] ?>)</h2>

<?= $this->render('task/changes', ['changes' => $changes, 'task' => $task, 'public' => true]) ?>
<?= $this->render('notification/footer', ['task' => $task]) ?>
</body>
</html>
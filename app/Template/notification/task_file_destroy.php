<html>
<body>
<h2><?= $this->text->e($task['title']) ?> (#<?= $task['id'] ?>)</h2>

<p><?= t('Attachment removed "%s"', $file['name']) ?></p>

<?= $this->render('notification/footer', ['task' => $task]) ?>
</body>
</html>
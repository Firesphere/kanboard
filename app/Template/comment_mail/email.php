<?= $this->text->markdown($email['comment'], true) ?>

<?= $this->render('notification/footer', ['task' => $task]) ?>

<div class="page-header">
    <h2><?= t('Remove a comment') ?></h2>
</div>

<div class="confirm">
    <p class="alert alert-info">
        <?= t('Do you really want to remove this comment?') ?>
    </p>

    <?= $this->render('comment/show', [
        'comment'      => $comment,
        'task'         => $task,
        'hide_actions' => true,
    ]) ?>

    <?= $this->modal->confirmButtons(
        'CommentController',
        'remove',
        ['task_id' => $task['id'], 'comment_id' => $comment['id']],
    ) ?>
</div>

<p class="activity-title">
    <?= e(
        '%s commented the task %s',
        $this->text->e($author),
        $this->url->link(t('#%d', $task['id']), 'TaskViewController', 'show', ['task_id' => $task['id']]),
    ) ?>
    <small class="activity-date"><?= $this->dt->datetime($date_creation) ?></small>
</p>
<div class="activity-description">
    <p class="activity-task-title"><?= $this->text->e($task['title']) ?></p>
    <div class="markdown"><?= $this->text->markdown($comment['comment']) ?></div>
</div>

<p class="activity-title">
    <?= e(
        '%s removed a file from the task %s',
        $this->text->e($author),
        $this->url->link(t('#%d', $task['id']), 'TaskViewController', 'show', ['task_id' => $task['id']]),
    ) ?>
    <small class="activity-date"><?= $this->dt->datetime($date_creation) ?></small>
</p>
<div class="activity-description">
    <p class="activity-task-title"><?= $this->text->e($file['name']) ?></p>
</div>

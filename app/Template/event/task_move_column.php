<p class="activity-title">
    <?= e(
        '%s moved the task %s to the column "%s"',
        $this->text->e($author),
        $this->url->link(t('#%d', $task['id']), 'TaskViewController', 'show', ['task_id' => $task['id']]),
        $this->text->e($task['column_title']),
    ) ?>
    <small class="activity-date"><?= $this->dt->datetime($date_creation) ?></small>
</p>
<div class="activity-description">
    <p class="activity-task-title"><?= $this->text->e($task['title']) ?></p>
</div>

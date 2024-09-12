<?php

namespace Kanboard\Model;

use Kanboard\Core\Base;

/**
 * Task Model
 *
 * @package  Kanboard\Model
 * @author   Frederic Guillot
 */
class TaskModel extends Base
{
    /**
     * SQL table name
     *
     * @var string
     */
    public const TABLE = 'tasks';

    /**
     * Task status
     *
     * @var integer
     */
    public const STATUS_OPEN = 1;
    public const STATUS_CLOSED = 0;

    /**
     * Events
     *
     * @var string
     */
    public const EVENT_MOVE_PROJECT = 'task.move.project';
    public const EVENT_MOVE_COLUMN = 'task.move.column';
    public const EVENT_MOVE_POSITION = 'task.move.position';
    public const EVENT_MOVE_SWIMLANE = 'task.move.swimlane';
    public const EVENT_UPDATE = 'task.update';
    public const EVENT_CREATE = 'task.create';
    public const EVENT_CLOSE = 'task.close';
    public const EVENT_OPEN = 'task.open';
    public const EVENT_CREATE_UPDATE = 'task.create_update';
    public const EVENT_ASSIGNEE_CHANGE = 'task.assignee_change';
    public const EVENT_OVERDUE = 'task.overdue';
    public const EVENT_USER_MENTION = 'task.user.mention';
    public const EVENT_DAILY_CRONJOB = 'task.cronjob.daily';

    /**
     * Recurrence: status
     *
     * @var integer
     */
    public const RECURRING_STATUS_NONE = 0;
    public const RECURRING_STATUS_PENDING = 1;
    public const RECURRING_STATUS_PROCESSED = 2;

    /**
     * Recurrence: trigger
     *
     * @var integer
     */
    public const RECURRING_TRIGGER_FIRST_COLUMN = 0;
    public const RECURRING_TRIGGER_LAST_COLUMN = 1;
    public const RECURRING_TRIGGER_CLOSE = 2;

    /**
     * Recurrence: timeframe
     *
     * @var integer
     */
    public const RECURRING_TIMEFRAME_DAYS = 0;
    public const RECURRING_TIMEFRAME_MONTHS = 1;
    public const RECURRING_TIMEFRAME_YEARS = 2;

    /**
     * Recurrence: base date used to calculate new due date
     *
     * @var integer
     */
    public const RECURRING_BASEDATE_DUEDATE = 0;
    public const RECURRING_BASEDATE_TRIGGERDATE = 1;

    /**
     * Remove a task
     *
     * @access public
     * @param  integer $task_id Task id
     * @return boolean
     */
    public function remove($task_id)
    {
        if (!$this->taskFinderModel->exists($task_id)) {
            return false;
        }

        $this->taskFileModel->removeAll($task_id);

        return $this->db->table(self::TABLE)->eq('id', $task_id)->remove();
    }

    /**
     * Get a the task id from a text
     *
     * Example: "Fix bug #1234" will return 1234
     *
     * @access public
     * @param  string $message Text
     * @return integer
     */
    public function getTaskIdFromText($message)
    {
        if (preg_match('!#(\d+)!i', $message, $matches) && isset($matches[1])) {
            return $matches[1];
        }

        return 0;
    }

    /**
     * Get task progress based on the column position
     *
     * @access public
     * @param  array $task
     * @param  array $columns
     * @return integer
     */
    public function getProgress(array $task, array $columns)
    {
        if ($task['is_active'] == self::STATUS_CLOSED) {
            return 100;
        }

        $position = 0;

        foreach ($columns as $column_id => $column_title) {
            if ($column_id == $task['column_id']) {
                break;
            }

            $position++;
        }

        return round(($position * 100) / count($columns), 1);
    }

    public function getOpenTaskCountBySwimlaneAndColumn($project_id)
    {
        return $this->db->table(self::TABLE)
            ->columns('swimlane_id', 'column_id', 'COUNT(*) AS nb_open_tasks')
            ->eq('project_id', $project_id)
            ->eq('is_active', 1)
            ->groupBy('swimlane_id', 'column_id')
            ->findAll();
    }
}

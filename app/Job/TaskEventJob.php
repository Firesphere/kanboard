<?php

namespace Kanboard\Job;

use Kanboard\Event\TaskEvent;
use Kanboard\EventBuilder\TaskEventBuilder;
use Kanboard\Model\TaskModel;

/**
 * Class TaskEventJob
 *
 * @package Kanboard\Job
 * @author  Frederic Guillot
 */
class TaskEventJob extends BaseJob
{
    /**
     * Execute job
     *
     * @param int $taskId
     * @param array $eventNames
     * @param array $changes
     * @param array $values
     * @param array $task
     */
    public function execute($taskId, array $eventNames, array $changes = [], array $values = [], array $task = [])
    {
        $event = TaskEventBuilder::getInstance($this->container)
            ->withTaskId($taskId)
            ->withChanges($changes)
            ->withValues($values)
            ->withTask($task)
            ->buildEvent();

        if ($event !== null) {
            foreach ($eventNames as $eventName) {
                $this->fireEvent($eventName, $event);
            }
        }
    }

    /**
     * Trigger event
     *
     * @access protected
     * @param string $eventName
     * @param TaskEvent $event
     */
    protected function fireEvent($eventName, TaskEvent $event)
    {
        $this->logger->debug(__METHOD__ . ' Event fired: ' . $eventName);
        $this->dispatcher->dispatch($event, $eventName);

        if ($eventName === TaskModel::EVENT_CREATE) {
            $userMentionJob = $this->userMentionJob->withParams($event['task']['description'], TaskModel::EVENT_USER_MENTION, $event);
            $this->queueManager->push($userMentionJob);
        }
    }

    /**
     * Set job params
     *
     * @param int $taskId
     * @param array $eventNames
     * @param array $changes
     * @param array $values
     * @param array $task
     * @return $this
     */
    public function withParams($taskId, array $eventNames, array $changes = [], array $values = [], array $task = [])
    {
        $this->jobParams = [$taskId, $eventNames, $changes, $values, $task];

        return $this;
    }
}
